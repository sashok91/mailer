<?php
namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\AdminRepositoryInterface',
            'App\Repositories\AdminRepository'
        );
    }
}