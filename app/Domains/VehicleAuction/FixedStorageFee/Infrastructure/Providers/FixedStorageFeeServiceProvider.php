<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\FixedStorageFee\Infrastructure\Providers;

use App\Domains\VehicleAuction\FixedStorageFee\Domain\Repositories\FixedStorageFeeDtoRepositoryInterface;
use App\Domains\VehicleAuction\FixedStorageFee\Infrastructure\Repositories\FixedStorageFeeDtoRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

final class FixedStorageFeeServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->scoped(
            abstract: FixedStorageFeeDtoRepositoryInterface::class,
            concrete: FixedStorageFeeDtoRepository::class,
        );
    }

    public function provides(): array
    {
        return [
            FixedStorageFeeDtoRepositoryInterface::class,
        ];
    }
}
