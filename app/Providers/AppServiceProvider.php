<?php

namespace App\Providers;

use App\Api\Api;
use App\Api\GitHubAPI;
use App\Process\GitHubInterface;
use App\Process\HubCommand;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Process\Process;
use App\Process\Process as AppProcess;
use Symfony\Component\Filesystem\Filesystem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GitHubAPI::class,function (){
            $config = config('services.github');
            $client = HttpClient::createForBaseUri($config['base'],[
                'auth_basic' => $config['token'],
            ]);

            return new Api($client);
        });

        $this->app->bind(GitHubInterface::class,function(){
            $process = $this->app->make(AppProcess::class);
            $fileSystem = $this->app->make(Filesystem::class);
            $path = base_path(config('services.github.clone_path','/tmp'));
            return new HubCommand($process,$fileSystem,$path);
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
