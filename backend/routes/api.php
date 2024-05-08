<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectSettingController;
use App\Http\Controllers\TemplateController;
use App\Http\Middleware\CompanyMiddleware;
use App\Http\Middleware\ProjectMiddleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(CompanyMiddleware::class)->prefix('company/')->group(function(){
    // COMPANY ROUTES
    Route::prefix('/company')->group(function(){
        Route::post('/list', [CompanyController::class, 'index']);
        Route::post('/store', [CompanyController::class, 'store']);
        Route::post('/get_company', [CompanyController::class, 'show']);
        Route::post('/update', [CompanyController::class, 'update']);
        Route::delete('/destroy/{company}', [CompanyController::class, 'destroy']);
    });
    // END COMPANY ROUTES

    // PAYMENT ROUTES
    Route::post('/get_company_payments', [PaymentController::class, 'getCompanyPayments']);
    // END PAYMENT ROUTES

    // PROJECT ROUTES
    Route::post('/get_company_projects', [ProjectController::class, 'getCompanyProjects']);
    // END PROJECT ROUTES

    // PAYMENT METHODS
    Route::post('/get_payment_methods', [PaymentMethodController::class, 'getPaymentMethods']);
    // END PAYMENT METHODS
});

Route::middleware(ProjectMiddleware::class)->prefix('project/')->group(function(){
    // COUPON ROUTES
    Route::prefix('/coupon')->group(function(){
        Route::post('/store', [CouponController::class, 'store']);
        Route::post('/get_coupon', [CouponController::class, 'show']);
        Route::post('/update', [CouponController::class, 'update']);
        Route::delete('/destroy/{coupon}', [CouponController::class, 'destroy']);
        Route::post('/download_coupon', [CouponController::class, 'downloadCoupon']);
        Route::post('/send_coupon', [CouponController::class, 'sendCoupon']);
    });
    // END COUPON ROUTES

    // ORDER ROUTES
    Route::prefix('/order')->group(function(){
        Route::post('/store', [OrderController::class, 'store']);
        Route::post('/get_order', [OrderController::class, 'show']);
        Route::post('/update', [OrderController::class, 'update']);
        Route::delete('/destroy/{order}', [OrderController::class, 'destroy']);
        Route::post('/place_order', [OrderController::class, 'placeOrder']);
    });
    // END ORDER ROUTES

    // PAYMENT ROUTES
    Route::prefix('/payment')->group(function(){
        Route::post('/store', [PaymentController::class, 'store']);
        Route::post('/get_payment', [PaymentController::class, 'show']);
        Route::post('/update', [PaymentController::class, 'update']);
        Route::post('/pay', [PaymentController::class, 'pay']);
        Route::delete('/destroy/{payment}', [PaymentController::class, 'destroy']);
        Route::post('/get_project_payments', [PaymentController::class, 'getProjectPayments']);
    });
    // END PAYMENT ROUTES

    // PROJECT ROUTES
    Route::prefix('/project')->group(function(){
        Route::post('/store', [ProjectController::class, 'store']);
        Route::post('/get_project', [ProjectController::class, 'show']);
        Route::post('/update', [ProjectController::class, 'update']);
        Route::delete('/destroy/{project}', [ProjectController::class, 'destroy']);
    });
    // END PROJECT ROUTES

    // PROJECT SETTINGS ROUTES
    Route::prefix('/project_settings')->group(function(){
        Route::post('/store', [ProjectSettingController::class, 'store']);
        Route::post('/get_project_setting', [ProjectSettingController::class, 'show']);
        Route::post('/update', [ProjectSettingController::class, 'update']);
        Route::post('/get_project_settings', [ProjectSettingController::class, 'getProjectSettings']);
    });
    // END PROJECT SETTINGS ROUTES

    // PROJECT TEMPLATES ROUTES
    Route::prefix('/templates')->group(function(){
        Route::post('/store', [TemplateController::class, 'store']);
        Route::post('/update', [TemplateController::class, 'update']);
        Route::delete('/destroy', [TemplateController::class, 'destroy']);
        Route::post('/get_streamed_project_templates', [TemplateController::class, 'streamProjectTemplates']);
        Route::post('/get_all_project_templates', [TemplateController::class, 'getAllTemplates']);
        Route::post('/get_all_active_project_templates', [TemplateController::class, 'getAllActiveTemplates']);
    });
    // END PROJECT TEMPLATES ROUTES

    // PROJECT PAYMENT METHODS ROUTES
    Route::prefix('/payment_method')->group(function(){
        Route::post('/store', [PaymentMethodController::class, 'store']);
        Route::post('/update', [PaymentMethodController::class, 'update']);
        Route::delete('/destroy', [PaymentMethodController::class, 'destroy']);
    });
    // END PROJECT TEMPLATES ROUTES

    // PROJECT FAQS ROUTES
    Route::prefix('/faq')->group(function(){
        Route::post('/store', [FaqController::class, 'store']);
        Route::post('/get_faq', [FaqController::class, 'retrieveModel']);
        Route::post('/update', [FaqController::class, 'update']);
        Route::post('/destroy/{faq}', [FaqController::class, 'destroy']);
        Route::post('/get_project_faqs', [FaqController::class, 'getProjectFaqs']);
    });
    // END PROJECT TEMPLATES ROUTES
});

//// OUT OF MIDDLEWARE ROUTES FOR EXTERNAL SOURCES
Route::post('/order/confirm_paid_order', [PaymentController::class, 'confirmPaidOrder']);
//// END
