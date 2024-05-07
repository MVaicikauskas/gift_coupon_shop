<?php

namespace App\Providers;

use App\Repository\BaseRepositoryInterface;
use App\Repository\CompanyRepositoryInterface;
use App\Repository\CouponRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\CompanyRepository;
use App\Repository\Eloquent\CouponRepository;
use App\Repository\Eloquent\FaqRepository;
use App\Repository\Eloquent\OrderRepository;
use App\Repository\Eloquent\PaymentMethodRepository;
use App\Repository\Eloquent\PaymentRepository;
use App\Repository\Eloquent\ProjectRepository;
use App\Repository\Eloquent\ProjectSettingRepository;
use App\Repository\Eloquent\TemplateRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\FaqRepositoryInterface;
use App\Repository\OrderRepositoryInterface;
use App\Repository\PaymentMethodRepositoryInterface;
use App\Repository\PaymentRepositoryInterface;
use App\Repository\ProjectRepositoryInterface;
use App\Repository\ProjectSettingRepositoryInterface;
use App\Repository\TemplateRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(CouponRepositoryInterface::class, CouponRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->bind(ProjectSettingRepositoryInterface::class, ProjectSettingRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TemplateRepositoryInterface::class, TemplateRepository::class);
        $this->app->bind(FaqRepositoryInterface::class, FaqRepository::class);
        $this->app->bind(PaymentMethodRepositoryInterface::class, PaymentMethodRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
