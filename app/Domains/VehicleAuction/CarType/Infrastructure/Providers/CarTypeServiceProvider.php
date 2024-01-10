<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Infrastructure\Providers;

use App\Domains\VehicleAuction\CarType\Domain\Repositories\CarTypeDtoRepositoryInterface;
use App\Domains\VehicleAuction\CarType\Domain\Repositories\CarTypeEntityRepositoryInterface;
use App\Domains\VehicleAuction\CarType\Infrastructure\Repositories\CarTypeDtoRepository;
use App\Domains\VehicleAuction\CarType\Infrastructure\Repositories\CarTypeEntityRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

final class CarTypeServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->scoped(
            abstract: CarTypeEntityRepositoryInterface::class,
            concrete: CarTypeEntityRepository::class,
        );

        $this->app->scoped(
            abstract: CarTypeDtoRepositoryInterface::class,
            concrete: CarTypeDtoRepository::class,
        );
    }

    public function provides(): array
    {
        return [
            CarTypeEntityRepositoryInterface::class,
            CarTypeDtoRepositoryInterface::class,
        ];
    }
}
