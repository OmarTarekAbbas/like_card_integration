<?php

namespace App\Providers;

use App\Constants\OperatorCode;
use App\Constants\OrderStatus;
use App\Constants\PaymentType;
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
      // make your own query file
      if(env('APP_DEBUG')) {
        \DB::listen(function($query){
            \File::append(
                storage_path('logs/query.log'),
                $query->sql . '[' . implode(', ', $query->bindings) . ']' . PHP_EOL
            );
        });
      }
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
        $view->with("orderStatus", OrderStatus::class);
        $view->with("paymentType", PaymentType::class);
      });

    }
}
