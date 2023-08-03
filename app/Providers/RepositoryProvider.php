<?php

namespace App\Providers;

use App\Repository\KabupatenImplements;
use App\Repository\KabupatenRepository;
use App\Repository\PendudukImplements;
use App\Repository\PendudukRepository;
use App\Repository\ProvinsiRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\ProvinsiImplements;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ProvinsiRepository::class, ProvinsiImplements::class);
        $this->app->bind(KabupatenRepository::class, KabupatenImplements::class);
        $this->app->bind(PendudukRepository::class, PendudukImplements::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
