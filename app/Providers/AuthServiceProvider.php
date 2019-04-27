<?php

namespace App\Providers;


use App\Models\Contract;
use App\Models\EmployeeContract;
use App\Models\Group;
use App\Models\User;
use App\Policies\ContractPolicy;
use App\Policies\EmployeeContractPolicy;
use App\Policies\GroupPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Group::class => GroupPolicy::class,
        Contract::class => ContractPolicy::class,
        EmployeeContract::class => EmployeeContractPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

    }
}
