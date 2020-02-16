<?php

namespace App\Providers;

use App\Api\Api;
use App\Api\GitHubAPI;
use App\Process\GitHubInterface;
use App\Process\HubCommand;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Process\Process;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GitHubInterface::class,HubCommand::class);
        $this->app->bind(GitHubAPI::class,function (){
            $config = config('services.github');
            $client = HttpClient::createForBaseUri($config['base'],[
                'auth_basic' => $config['token'],
            ]);

            return new Api($client);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
