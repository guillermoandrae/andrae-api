<?php

namespace App\Providers;

use App\Console\Commands\ImportPostsCommand;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('command.import.posts', function () {
            return new ImportPostsCommand();
        });

        $this->commands(
            'command.import.posts'
        );
    }
}
