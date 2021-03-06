<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
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

        #Client Secret Hashing
        #If you would like your client's secrets to be hashed when stored in your database,
        #you should call the Passport::hashClientSecrets method in the boot method of your AppServiceProvider:
        Passport::hashClientSecrets();

        #Token Lifetimes
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        #Deploying Passport
        Passport::loadKeysFrom(storage_path('/oauth'));

        /**
         * Creating A Personal Access Client
         * Before your application can issue personal access tokens, you will need to create a personal access client. You may do this using the passport:client command with the --personal option. If you have already run the passport:install command, you do not need to run this command:
         */
        Passport::personalAccessClientId(
            config('passport.personal_access_client.id')
        );
        Passport::personalAccessClientSecret(
            config('passport.personal_access_client.secret')
        );
    }
}
