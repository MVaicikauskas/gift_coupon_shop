<?php

use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
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

Route::middleware(\App\Http\Middleware\ApiMiddleware::class)->group(function(){
    Route::post('/get_project_settings', [ProjectSettingController::class, 'getProjectSettings']);
    Route::post('/place_order', [OrderController::class, 'store']);
    Route::post('/order_payment', [PaymentController::class, 'pay']);
    Route::post('/download_coupon', [CouponController::class, 'downloadCoupon']);
    Route::post('/send_coupon', [CouponController::class, 'sendCoupon']);
    Route::post('/get_streamed_project_templates', [TemplateController::class, 'streamProjectTemplates']);
});

