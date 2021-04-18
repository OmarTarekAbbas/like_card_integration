<?php

namespace App\Providers;

use App\Constants\OperatorCode;
use App\Constants\OrderStatus;
use App\Services\PaymentInterface;
use App\Services\DcbPaymentService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Schema::defaultStringLength(191);

      $this->app->singleton(PaymentInterface::class, DcbPaymentService::class);

      View::composer("*", function ($view) {
        $view->with("operatorCode", OperatorCode::class);
      });

      View::composer("*", function ($view) {
        $view->with("orderStatus", OrderStatus::class);
      });

    }
}
