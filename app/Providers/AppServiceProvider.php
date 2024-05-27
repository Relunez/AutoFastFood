<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Repositories\PedidoRepository;
use App\Http\Repositories\PedidoRepositoryInterface;
use App\Http\Repositories\ProdutoRepository;
use App\Http\Repositories\ProdutoRepositoryInterface;
use App\Http\Repositories\ClienteRepository;
use App\Http\Repositories\ClienteRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ClienteRepositoryInterface::class, ClienteRepository::class);
        $this->app->singleton('ClienteService', function ($app) {
            return $app->make(\App\Http\Services\ClienteService::class);
        });

        $this->app->bind(PedidoRepositoryInterface::class, PedidoRepository::class);
        $this->app->singleton('PedidoService', function ($app) {
            return $app->make(\App\Http\Services\PedidoService::class);
        });

        $this->app->bind(ProdutoRepositoryInterface::class, ProdutoRepository::class);
        $this->app->singleton('ProdutoService', function ($app) {
            return $app->make(\App\Http\Services\ProdutoService::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
