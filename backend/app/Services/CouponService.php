<?php

namespace App\Services;

use App\Http\Resources\CouponResource;
use App\Http\Resources\ProjectResource;
use App\Interfaces\CouponServiceInterface;
use App\Jobs\SendCoupon;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Project;
use App\Models\ProjectSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CouponService implements CouponServiceInterface
{
    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function store(array $data): void
    {
        DB::beginTransaction();

        try {
            /** @var string $code */
            $code = (new CouponService)->checkCodeRecursively(substr(hash('sha256', openssl_random_pseudo_bytes(20)),-10));

            /** @var ProjectSetting $projectSettings */
            $projectSettings = null;

            if (! $project = Project::with([
                Project::RELATION_SETTINGS
            ])->findOrFail($data[Coupon::EXTRA_COL_PROJECT_ID])) {
                throw new \Exception('Invalid parameters');
            }

            $projectSettings = $project->{Project::RELATION_SETTINGS}->first()->{ProjectSetting::COL_SETTINGS};

            /** @var int $expirationTerm */
            $expirationTerm = $projectSettings[ProjectSetting::SETTING_KEY_EXPIRATION_TERM];

            $coupon = new Coupon();
            $coupon->{Coupon::COL_RECIPIENT_NAME} = $data[Coupon::COL_RECIPIENT_NAME];
            $coupon->{Coupon::COL_VALUE} = $data[Coupon::COL_VALUE];
            $coupon->{Coupon::COL_EMAIL} = $data[Coupon::COL_EMAIL];
            $coupon->{Coupon::COL_WISH} = $data[Coupon::COL_WISH];
            $coupon->{Coupon::COL_ACCEPT_PRIVACY_POLICY} = boolval(intval($data[Coupon::COL_ACCEPT_PRIVACY_POLICY]));
            $coupon->{Coupon::COL_COUPON_TYPE} = intval($data[Coupon::COL_COUPON_TYPE]);
            $coupon->{Coupon::COL_COUPON_DELIVERY} = intval($data[Coupon::COL_COUPON_DELIVERY]);
            $coupon->{Coupon::COL_CODE} = $code;
            $coupon->{Coupon::COL_EXPIRES_AT} = now()->addDays($expirationTerm);
            $coupon->save();

            $coupon->{Coupon::RELATION_PROJECT}()->attach($data[Coupon::EXTRA_COL_PROJECT_ID]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param string $code
     * @return string
     */
    private function checkCodeRecursively(string $code): string
    {
        if (! Coupon::where(Coupon::COL_CODE, $code)->count()) {
            return $code;
        }

        $code = substr(hash('sha256', openssl_random_pseudo_bytes(20)),-10);

        return self::checkCodeRecursively($code);
    }

    /**
     * @param Coupon $coupon
     * @return CouponResource
     */
    public function prepareForExposure(Coupon $coupon): CouponResource
    {
        return new CouponResource($coupon);
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

            Coupon::findOrFail($data[Coupon::COL_ID])->update([
                Coupon::COL_RECIPIENT_NAME => $data[Coupon::COL_RECIPIENT_NAME],
                Coupon::COL_VALUE => $data[Coupon::COL_VALUE],
                Coupon::COL_EMAIL => $data[Coupon::COL_EMAIL],
                Coupon::COL_WISH => $data[Coupon::COL_WISH],
                Coupon::COL_ACCEPT_PRIVACY_POLICY => boolval(intval($data[Coupon::COL_ACCEPT_PRIVACY_POLICY])),
                Coupon::COL_COUPON_TYPE => intval($data[Coupon::COL_COUPON_TYPE]),
                Coupon::COL_COUPON_DELIVERY => intval($data[Coupon::COL_COUPON_DELIVERY]),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param Coupon $coupon
     * @return void
     * @throws \Throwable
     */
    public function destroy(Coupon $coupon): void
    {
        DB::beginTransaction();

        try {
            $coupon->deleteOrFail();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param array $data
     * @return void
     */
    public function downloadCoupon(array $data): void
    {
        // TODO decide how this step going to look like
    }

    /**
     * @param array $data
     * @return void
     */
    public function sendCoupon(array $data): void
    {
        $mailData = [];

        $mailData['recipient_email'] = $data[Coupon::COL_EMAIL];

        $mailData['coupon'] = new CouponResource(Order::with([
            Order::RELATION_COUPON
        ])->findORFail($data[Order::COL_ID])->{Order::RELATION_COUPON}->first());

        $mailData['project'] = new ProjectResource(Project::findOrFail($data[Coupon::EXTRA_COL_PROJECT_ID]));

        SendCoupon::dispatch($mailData);
    }
}
