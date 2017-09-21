<?php

namespace App\Providers;

use App\Contracts\CustomerRepositoryInterface;
use App\Repositories\Cache\CacheCustomerRepository;
use App\Repositories\CustomerRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CustomerRepositoryInterface::class, function() {
            $customerRepository = new CustomerRepository;

            return new CacheCustomerRepository($customerRepository, $this->app['cache.store']);
        });
    }
}
