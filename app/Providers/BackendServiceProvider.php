<?php
namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repositories\AdminRepositoryInterface', 'App\Repositories\AdminRepository');
        $this->app->bind('App\Repositories\SubscriberRepositoryInterface', 'App\Repositories\SubscriberRepository');
        $this->app->bind('App\Repositories\MailingGroupRepositoryInterface', 'App\Repositories\MailingGroupRepository');
        $this->app->bind('App\Repositories\MailingRepositoryInterface', 'App\Repositories\MailingRepository');
    }
}