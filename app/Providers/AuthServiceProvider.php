<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\City;
use App\Models\Country;
use App\Policies\CityPolicy;
use App\Policies\CountryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        City::class => CityPolicy::class,
        Country::class => CountryPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
