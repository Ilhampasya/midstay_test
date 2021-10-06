<?php

namespace App\Providers;

use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ResponseFactory::macro('jsonApi', function ($data = [], $success = true, $status = 200, array $headers = [], $options = 0) {
            return $this->json([
                'success' => $success,
                'status' => $status,
                'message' => Response::$statusTexts[$status] ?? '',
                'data' => $data,
            ], $status, $headers, $options);
        });
    }
}
