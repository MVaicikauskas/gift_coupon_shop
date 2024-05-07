<?php

namespace App\Providers;

use App\Interfaces\CompanyServiceInterface;
use App\Interfaces\CouponServiceInterface;
use App\Interfaces\FaqServiceInterface;
use App\Interfaces\OrderServiceInterface;
use App\Interfaces\PaymentMethodServiceInterface;
use App\Interfaces\PaymentServiceInterface;
use App\Interfaces\ProjectServiceInterface;
use App\Interfaces\ProjectSettingServiceInterface;
use App\Interfaces\TemplateServiceInterface;
use App\Services\CompanyService;
use App\Services\CouponService;
use App\Services\FaqService;
use App\Services\OrderService;
use App\Services\PaymentMethodService;
use App\Services\PaymentService;
use App\Services\ProjectService;
use App\Services\ProjectSettingService;
use App\Services\TemplateService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CompanyServiceInterface::class, CompanyService::class);
        $this->app->bind(CouponServiceInterface::class, CouponService::class);
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
        $this->app->bind(PaymentServiceInterface::class, PaymentService::class);
        $this->app->bind(ProjectServiceInterface::class, ProjectService::class);
        $this->app->bind(ProjectSettingServiceInterface::class, ProjectSettingService::class);
        $this->app->bind(TemplateServiceInterface::class, TemplateService::class);
        $this->app->bind(PaymentMethodServiceInterface::class, PaymentMethodService::class);
        $this->app->bind(FaqServiceInterface::class, FaqService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
