<?php

namespace App\Providers;

use App\Models\AdminNotification;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;


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
        Paginator::useTailwind();
        Schema::defaultStringLength(191);

        View::composer('admin.layouts.app', function( $view )
        {
            $admin_notify = AdminNotification::where('read_notification',0)->orderBy('created_at','DESC')->get();
            $view->with( 'admin_notify', $admin_notify );
        } );
    }
}
