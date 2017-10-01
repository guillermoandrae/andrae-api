<?php

namespace App\Providers;

use App\Repositories\DynamoDb\PostRepository;
use App\Repositories\DynamoDb\UserRepository;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Aws\DynamoDb\DynamoDbClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(DynamoDbClient::class, function () {
            $options = [
                'version' => 'latest',
                'region' => env('AWS_REGION'),
                'credentials' => [
                    'key' => env('AWS_ACCESS_KEY_ID'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY'),
                ],
            ];
            if ($endpoint = env('AWS_DYNAMODB_ENDPOINT')) {
                $options['endpoint'] = $endpoint;
            }
            return new DynamoDbClient($options);
        });
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
    }
}
