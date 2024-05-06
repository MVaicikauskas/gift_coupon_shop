<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectSettingController;
use App\Http\Controllers\TemplateController;
use Illuminate\Http\Request;
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

Route::middleware(\App\Http\Middleware\CompanyMiddleware::class)->prefix('company/')->group(function(){
    // COMPANY ROUTES
    Route::prefix('/company')->group(function(){
        Route::get('/list', [CompanyController::class, 'index']);
        Route::post('/store', [CompanyController::class, 'store']);
        Route::get('/show', [CompanyController::class, 'show']);
        Route::get('/edit', [CompanyController::class, 'edit']);
        Route::post('/update', [CompanyController::class, 'update']);
        Route::delete('/destroy', [CompanyController::class, 'destroy']);
    });
    // END COMPANY ROUTES

    // PAYMENT ROUTES
    Route::post('/get_company_payments', [PaymentController::class, 'getCompanyPayments']);
    // END PAYMENT ROUTES

    // PROJECT ROUTES
    Route::post('/get_company_projects', [ProjectController::class, 'getCompanyProjects']);
    // END PROJECT ROUTES
});

Route::middleware(\App\Http\Middleware\ProjectMiddleware::class)->prefix('project/')->group(function(){
    // COUPON ROUTES
    Route::prefix('/coupon')->group(function(){
        Route::post('/store', [CouponController::class, 'store']);
        Route::get('/show', [CouponController::class, 'show']);
        Route::get('/edit', [CouponController::class, 'edit']);
        Route::post('/update', [CouponController::class, 'update']);
        Route::delete('/destroy', [CouponController::class, 'destroy']);
        Route::post('/download_coupon', [CouponController::class, 'downloadCoupon']);
        Route::post('/send_coupon', [CouponController::class, 'sendCoupon']);
    });
    // END COUPON ROUTES

    // ORDER ROUTES
    Route::prefix('/order')->group(function(){
        Route::post('/store', [OrderController::class, 'store']);
        Route::get('/show', [OrderController::class, 'show']);
        Route::get('/edit', [OrderController::class, 'edit']);
        Route::post('/update', [OrderController::class, 'update']);
        Route::delete('/destroy', [OrderController::class, 'destroy']);
        Route::post('/place_order', [OrderController::class, 'placeOrder']);
    });
    // END ORDER ROUTES

    // PAYMENT ROUTES
    Route::prefix('/payment')->group(function(){
        Route::post('/store', [PaymentController::class, 'store']);
        Route::get('/show', [PaymentController::class, 'show']);
        Route::get('/edit', [PaymentController::class, 'edit']);
        Route::post('/update', [PaymentController::class, 'update']);
        Route::delete('/destroy', [PaymentController::class, 'destroy']);
        Route::post('/get_project_payments', [PaymentController::class, 'getProjectPayments']);
    });
    // END PAYMENT ROUTES

    // PROJECT ROUTES
    Route::prefix('/project')->group(function(){
        Route::post('/store', [ProjectController::class, 'store']);
        Route::get('/show', [ProjectController::class, 'show']);
        Route::get('/edit', [ProjectController::class, 'edit']);
        Route::post('/update', [ProjectController::class, 'update']);
        Route::delete('/destroy', [ProjectController::class, 'destroy']);
    });
    // END PROJECT ROUTES

    // PROJECT SETTINGS ROUTES
    Route::prefix('/project_settings')->group(function(){
        Route::post('/store', [ProjectSettingController::class, 'store']);
        Route::get('/show', [ProjectSettingController::class, 'show']);
        Route::get('/edit', [ProjectSettingController::class, 'edit']);
        Route::post('/update', [ProjectSettingController::class, 'update']);
        Route::post('/get_project_settings', [ProjectSettingController::class, 'getProjectSettings']);
    });
    // END PROJECT SETTINGS ROUTES

    // PROJECT TEMPLATES ROUTES
    Route::prefix('/project_templates')->group(function(){
        Route::post('/store', [TemplateController::class, 'store']);
        Route::post('/update', [TemplateController::class, 'update']);
        Route::post('/get_streamed_project_templates', [TemplateController::class, 'streamProjectTemplates']);
        Route::post('/get_all_project_templates', [TemplateController::class, 'getAllTemplates']);
        Route::post('/get_all_active_project_templates', [TemplateController::class, 'getAllActiveTemplates']);
    });
    // END PROJECT TEMPLATES ROUTES
});

