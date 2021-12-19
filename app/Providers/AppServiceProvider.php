<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
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
        Validator::extend('has', function ($attribute, $value, $parameters) {
            return request()->has($attribute);
        });

        Validator::extend('valid', function ($attribute, $value, $parameters) {
            $row = DB::table($parameters[0])->where($parameters[1],$value )->first();
            if($row) return true;
            return false;
        });

    }
}
