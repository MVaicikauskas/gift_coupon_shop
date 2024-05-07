<?php

namespace App\Services;

use App\Http\Resources\PaymentResource;
use App\Interfaces\OrderServiceInterface;
use App\Interfaces\PaymentMethodServiceInterface;
use App\Interfaces\PaymentServiceInterface;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Project;
use App\Models\ProjectSetting;
use App\Repository\PaymentRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use \Firebase\JWT\JWT;

class PaymentService implements PaymentServiceInterface
{
    private readonly PaymentRepositoryInterface $paymentRepository;
    private readonly OrderServiceInterface $orderService;
    private readonly PaymentMethodServiceInterface $paymentMethodService;

    // KNOWN PAYMENT METHODS
    const PAYMENT_METHOD_MONTONIO = 'montonio';
    // END KNOWN PAYMENT METHODS

    const DEFAULT_CURRENCY = 'EUR';
    const DEFAULT_LOCALE = 'lt';
    const DEFAULT_PAYMENT_METHOD = 'paymentInitiation';
    const DEFAULT_PREFERRED_COUNTRY = 'LT';
    const DEFAULT_NOTIFICATION_URL_SUFFIX = '/api/order/confirm_paid_order';

    /**
     * @param PaymentRepositoryInterface $paymentRepository
     * @param OrderServiceInterface $orderService
     * @param PaymentMethodServiceInterface $paymentMethodService
     */
    public function __construct(PaymentRepositoryInterface $paymentRepository, OrderServiceInterface $orderService, PaymentMethodServiceInterface $paymentMethodService)
    {
        $this->paymentRepository = $paymentRepository;
        $this->orderService = $orderService;
        $this->paymentMethodService = $paymentMethodService;
    }

    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function store(array $data): void
    {
        DB::beginTransaction();

        try {
            /** @var Payment $payment */
            $payment = new Payment();
            $payment->{Payment::COL_BANK_NAME} = $data[Payment::COL_BANK_NAME];
            $payment->{Payment::COL_BANK_CODE} = $data[Payment::COL_BANK_CODE];
            $payment->{Payment::COL_TRANSACTION_STATUS} = $data[Payment::COL_TRANSACTION_STATUS];
            $payment->{Payment::COL_PAYMENT_METHOD} = $data[Payment::COL_PAYMENT_METHOD];
            $payment->save();

            $payment->{Payment::RELATION_ORDER}()->attach($data[Payment::RELATED_KEY_ORDER_ID]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param int $paymentId
     * @return PaymentResource
     */
    public function prepareForExposure(int $paymentId): PaymentResource
    {
        return new PaymentResource($this->paymentRepository->getModelById($paymentId));
    }

    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function update(array $data): void
    {
        DB::beginTransaction();

        try {
            $this->paymentRepository->getModelById($data[Payment::COL_ID])->update([
                Payment::COL_BANK_NAME => $data[Payment::COL_BANK_NAME],
                Payment::COL_BANK_CODE => $data[Payment::COL_BANK_CODE],
                Payment::COL_TRANSACTION_STATUS => $data[Payment::COL_TRANSACTION_STATUS],
                Payment::COL_PAYMENT_METHOD => $data[Payment::COL_PAYMENT_METHOD],
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param Payment $payment
     * @return void
     * @throws \Throwable
     */
    public function destroy(Payment $payment): void
    {
        DB::beginTransaction();

        try {
            $payment->deleteOrFail();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param array $data
     * @return AnonymousResourceCollection
     */
    public function getProjectPayments(array $data): AnonymousResourceCollection
    {
        /** @var Collection $projectOrders */
        $projectOrders = $this->paymentRepository->getProjectPayments($data[Payment::EXTRA_COL_PROJECT_ID]);

        /** @var Collection $payments */
        $payments = new Collection();

        foreach ($projectOrders as $projectOrder) {
            if (!$projectOrder->{Order::RELATION_PAYMENT}) {
                continue;
            }

            $payments->push($projectOrder->{Order::RELATION_PAYMENT}->first());
        }

        return PaymentResource::collection($payments);
    }

    /**
     * @param array $data
     * @return AnonymousResourceCollection
     */
    public function getCompanyPayments(array $data): AnonymousResourceCollection
    {
        /** @var Collection $companyProjects */
        $companyProjects = $this->paymentRepository->getCompanyPayments($data[Payment::EXTRA_COL_COMPANY_ID]);

        /** @var Collection $payments */
        $payments = new Collection();

        foreach ($companyProjects as $project) {
            if (!$project->{Project::RELATION_ORDERS}->count()) {
                continue;
            }

            foreach ($project->{Project::RELATION_ORDERS} as $order) {
                if (!$order->{Order::RELATION_PAYMENT}) {
                    continue;
                }

                $payments->push($order->{Order::RELATION_PAYMENT}->first());
            }
        }

        return PaymentResource::collection($payments);
    }

    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function confirmPaidOrder(array $data): void
    {
        self::changeOrderPaymentStatus($data);
    }

    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    private function changeOrderPaymentStatus(array $data): void
    {
        DB::beginTransaction();

        try {
            /** @var Payment $orderPayment */
            $orderPayment = $this->paymentRepository->getOrderPayment($data[Payment::RELATED_KEY_ORDER_ID]);

            $orderPayment->update([
                Payment::COL_BANK_NAME => $data[Payment::COL_BANK_NAME] ?? $orderPayment->{Payment::COL_BANK_NAME},
                Payment::COL_BANK_CODE => $data[Payment::COL_BANK_CODE] ?? $orderPayment->{Payment::COL_BANK_CODE},
                Payment::COL_TRANSACTION_STATUS => $data[Payment::COL_TRANSACTION_STATUS] ?? $orderPayment->{Payment::COL_TRANSACTION_STATUS},
                Payment::COL_PAYMENT_METHOD => $data[Payment::COL_PAYMENT_METHOD] ?? $orderPayment->{Payment::COL_PAYMENT_METHOD},
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param array $data
     * @param string $locale )
     * @return string | null
     * @throws \Exception
     */
    public function pay(array $data, string $locale): ?string
    {
        DB::beginTransaction();

        try {
            /** @var int $orderId */
            $orderId = $this->orderService->store($data);

            /** @var ProjectSetting | null $projectSettings */
            $projectSettings = null;

            // Gathering order payment data to update existing payment with new data in any case
            // In case where something brakes need to change order's payment status to failed to mark that order wasn't paid because of an error
            $orderPaymentData = [
                Payment::COL_BANK_NAME => null,
                Payment::COL_BANK_CODE => $data[Order::COL_SELECTED_BANK],
                Payment::COL_TRANSACTION_STATUS => Payment::TRANSACTION_STATUS_ONGOING,
                Payment::COL_PAYMENT_METHOD=> null,
            ];

            if (! $project = Project::with([
                Project::RELATION_SETTINGS
            ])->findOrFail($data[Order::EXTRA_COL_PROJECT_ID])) {
                $orderPaymentData[Payment::COL_TRANSACTION_STATUS] = Payment::TRANSACTION_STATUS_FAILED;
                self::changeOrderPaymentStatus($orderPaymentData);

                throw new \Exception('Invalid parameters');
            }

            $projectSettings = $project->{Project::RELATION_SETTINGS}->first()->{ProjectSetting::COL_SETTINGS};

            if (is_string($projectSettings)) {
                $projectSettings = json_decode($projectSettings, true);
            }

            /** @var Collection $paymentMethods */
            $paymentMethods = $this->paymentMethodService->getPaymentMethods([]);

            foreach ($paymentMethods as $paymentMethod) {
                if ($paymentMethod->{PaymentMethod::COL_KEY} !== $projectSettings[ProjectSetting::SETTING_KEY_PAYMENT_METHOD]) {
                    continue;
                }

                if ($paymentMethod->{PaymentMethod::COL_IS_ACTIVE} === 0) {
                    $orderPaymentData[Payment::COL_TRANSACTION_STATUS] = Payment::TRANSACTION_STATUS_FAILED;
                    $orderPaymentData[Payment::COL_PAYMENT_METHOD] = $paymentMethod->{PaymentMethod::COL_KEY};
                    self::changeOrderPaymentStatus($orderPaymentData);

                    throw new \Exception('Chosen payment method is not active');
                }

                switch ($projectSettings[ProjectSetting::SETTING_KEY_PAYMENT_METHOD]) {
                    case self::PAYMENT_METHOD_MONTONIO:
                        // Gathering all necessary data to pass into 
                        $newDataArray = [
                            'order' => $data,
                            'order_id' => $orderId,
                            'project_settings' => $projectSettings,
                            'locale' => $locale,
                        ];

                        return self::payByMontonio($newDataArray);
                }
            }

            DB::commit();

            return null;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param array $data
     * @return string
     * @throws \Exception
     */
    private function payByMontonio(array $data): string
    {
        // 0. Prepare data which you're going to need
//        $orderPaymentData = [
//            Payment::COL_BANK_NAME => null,
//            Payment::COL_BANK_CODE => $data['order'][Order::COL_SELECTED_BANK],
//            Payment::COL_TRANSACTION_STATUS => Payment::TRANSACTION_STATUS_ONGOING,
//            Payment::COL_PAYMENT_METHOD=> self::PAYMENT_METHOD_MONTONIO,
//        ];

        /** @var string $accessKey */
        $accessKey = decrypt($data['project_settings'][ProjectSetting::SETTING_KEY_MONTONIO_ACCESS_KEY]);

        /** @var string $secretKey */
        $secretKey = decrypt($data['project_settings'][ProjectSetting::SETTING_KEY_MONTONIO_SECRET_KEY]);

        // TODO Solve how to determine which country should be selected automatically
        $paymentMethods = self::getPaymentMethodsMontonio($accessKey, $secretKey)['paymentInitiation']['setup']['LT']['paymentMethods'];


        /** @var string | null $preferredProvider */
        $preferredProvider = null;

        /** @var array $paymentMethod */
        foreach ($paymentMethods as $paymentMethod) {
            if ($paymentMethod['code'] !== $data['order'][Order::COL_SELECTED_BANK]) {
                continue;
            }

//            $orderPaymentData[Payment::COL_BANK_NAME] = $paymentMethod['name'];
            $preferredProvider = $data['order'][Order::COL_SELECTED_BANK];
        }

        if (! $preferredProvider) {
//            $orderPaymentData[Payment::COL_TRANSACTION_STATUS] = Payment::TRANSACTION_STATUS_FAILED;
//            self::changeOrderPaymentStatus($orderPaymentData);

            throw new \Exception('Preferred provider is not available');
        }

        // 1. Gather the checkout data
        $payload = [
            'accessKey'         => $accessKey,
            'merchantReference' => 'Order id:' . $data['order_id'],
            'returnUrl'         => $data['project_settings'][ProjectSetting::SETTING_KEY_RETURN_URL],
            'notificationUrl'   => url('') . self::DEFAULT_NOTIFICATION_URL_SUFFIX,
            'currency'          => self::DEFAULT_CURRENCY,
            'grandTotal'        => $data['order'][Order::COL_VALUE],
            'locale'            => $data['locale'] ?? self::DEFAULT_LOCALE,
            'lineItems'         => [
                [
                    'name'       => 'Gift Coupon',
                    'quantity'   => 1,
                    'finalPrice' => $data['order'][Order::COL_VALUE],
                ],
            ],
        ];

        // 2. Specify the Payment Method
        $payload['payment'] = [
            'method'        => self::DEFAULT_PAYMENT_METHOD,
            'methodDisplay' => 'Pay with your bank',
            'amount'        => $data['order'][Order::COL_VALUE], // Yes, this is the same as order->grandTotal.
            'currency'      => self::DEFAULT_CURRENCY, // This must match the currency of the order.
            'methodOptions' => [
                'paymentDescription' => 'Payment for order ' . $data['order'][Order::COL_ID],
                'preferredCountry'   => strtoupper($data['locale']) ?? self::DEFAULT_PREFERRED_COUNTRY,
                // This is the code of the bank that the customer chose at checkout.
                // See the GET /stores/payment-methods endpoint for the list of available banks.
                'preferredProvider'  => $preferredProvider,
            ],
        ];

        // add expiry to payment data for JWT validation
        $payload['exp'] = time() + (10 * 60);

        // 3. Generate the token using Firebase's JWT library
        $token = JWT::encode($payload, $secretKey, 'HS256');

        // Remove this var_dump once you want the header (location) to work correctly
//        var_dump($token);
        // eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhY2Nlc3NLZXkiOiJNWV9BQ0NFU1NfS0VZIiwibWVyY2hhbnRSZWZlcmVuY2UiOiJNWS1PUkRFUi1JRC0xMjMiLCJyZXR1cm5VcmwiOiJodHRwczovL215c3RvcmUuY29tL3BheW1lbnQvcmV0dXJuIiwibm90aWZpY2F0aW9uVXJsIjoiaHR0cHM6Ly9teXN0b3JlLmNvbS9wYXltZW50L25vdGlmeSIsImN1cnJlbmN5IjoiRVVSIiwiZ3JhbmRUb3RhbCI6OTkuOTg5OTk5OTk5OTk5OTk0ODg0MDkyMzAyNTI3Mjc4NjYxNzI3OTA1MjczNDM3NSwibG9jYWxlIjoiZW4iLCJiaWxsaW5nQWRkcmVzcyI6eyJmaXJzdE5hbWUiOiJDdXN0b21lckZpcnN0IiwibGFzdE5hbWUiOiJDdXN0b21lckxhc3QiLCJlbWFpbCI6ImN1c3RvbWVyQGN1c3RvbWVyLmNvbSIsImFkZHJlc3NMaW5lMSI6IkthaSAxIiwibG9jYWxpdHkiOiJUYWxsaW5uIiwicmVnaW9uIjoiSGFyanVtYWEiLCJjb3VudHJ5IjoiRUUiLCJwb3N0YWxDb2RlIjoiMTAxMTEifSwic2hpcHBpbmdBZGRyZXNzIjp7ImZpcnN0TmFtZSI6IkN1c3RvbWVyRmlyc3RTaGlwcGluZyIsImxhc3ROYW1lIjoiQ3VzdG9tZXJMYXN0U2hpcHBpbmciLCJlbWFpbCI6ImN1c3RvbWVyQGN1c3RvbWVyLmNvbSIsImFkZHJlc3NMaW5lMSI6IkthaSAxIiwibG9jYWxpdHkiOiJUYWxsaW5uIiwicmVnaW9uIjoiSGFyanVtYWEiLCJjb3VudHJ5IjoiRUUiLCJwb3N0YWxDb2RlIjoiMTAxMTEifSwibGluZUl0ZW1zIjpbeyJuYW1lIjoiSG92ZXJib2FyZCIsInF1YW50aXR5IjoxLCJmaW5hbFByaWNlIjo5OS45ODk5OTk5OTk5OTk5OTQ4ODQwOTIzMDI1MjcyNzg2NjE3Mjc5MDUyNzM0Mzc1fV0sInBheW1lbnQiOnsibWV0aG9kIjoicGF5bWVudEluaXRpYXRpb24iLCJtZXRob2REaXNwbGF5IjoiUGF5IHdpdGggeW91ciBiYW5rIiwiYW1vdW50Ijo5OS45ODk5OTk5OTk5OTk5OTQ4ODQwOTIzMDI1MjcyNzg2NjE3Mjc5MDUyNzM0Mzc1LCJjdXJyZW5jeSI6IkVVUiIsIm1ldGhvZE9wdGlvbnMiOnsicGF5bWVudFJlZmVyZW5jZSI6IlBBWU1FTlQtRk9SLU1ZLU9SREVSLUlELTEyMyIsInBheW1lbnREZXNjcmlwdGlvbiI6IlBheW1lbnQgZm9yIG9yZGVyIDM3IiwicHJlZmVycmVkQ291bnRyeSI6IkVFIiwicHJlZmVycmVkUHJvdmlkZXIiOiJMSFZCRUUyIn19LCJleHAiOjE2NzU4NjQwMTB9.sRq2ngH9eyYxNJy--s_SdpgL4bKYeTNhHrKYCkaHyDs

        // 4. Send the token to the API
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://sandbox-stargate.montonio.com/api/orders");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'data' => $token
        ]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        $result = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if (is_string($result)) {
            $result = json_decode($result, true);
        }

        if ($status >= 400) {
            // "{"statusCode":401,"message":"STORE_NOT_FOUND","error":"Unauthorized"}"
            /** @var string $message */
            $message = '';

            foreach ($result['message'] as $responseMessage) {
                if ($message) {
                    $message .= ', ' ;
                }
                $message .= $responseMessage;
            }

            throw new \Exception($message. ' (' . $result['error'] . ') ', $status);
        }

        // var_dump($data['paymentUrl']);
        // https://gateway.montonio.com/some-random-uuid

        // 6. Redirect the customer to the checkout page
        return $result['paymentUrl'];
    }

    /**
     * @param string $accessKey
     * @param string $secretKey
     * @return array
     * @throws \Exception
     */
    private function getPaymentMethodsMontonio(string $accessKey, string $secretKey): array
    {
        // 1. Create the authorization token payload
        $payload = [
            'accessKey' => $accessKey,
        ];

        // add expiry to the token for JWT validation
        $payload['exp'] = time() + (10 * 60);

        // 2. Generate the token using Firebase's JWT library
        $token = JWT::encode($payload, $secretKey, 'HS256');
        // var_dump($token);
        // eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhY2Nlc3NLZXkiOiIxZTU0ZTM4NS1hODBiLTRhYzQtYTY1MC1kNmZkNmY3OTA2NGIiLCJpYXQiOjE2OTE3NTQ0OTEsImV4cCI6MTY5MTc1NTA5MX0.nbv7DKAThu_4vaymKPJoTVqQHMZtZ7Hoonk6EAOEIkM

        // 3. Make the request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://sandbox-stargate.montonio.com/api/stores/payment-methods");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            "Authorization: Bearer ${token}"
        ]);

        $result = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if (is_string($result)) {
            $result = json_decode($result, true);
        }

        if ($status >= 400) {
            // "{"statusCode":401,"message":"STORE_NOT_FOUND","error":"Unauthorized"}"
            throw new \Exception($result['message'] . ': ' . $result['error'], $status);
        }

        return $result['paymentMethods'];
    }
}
