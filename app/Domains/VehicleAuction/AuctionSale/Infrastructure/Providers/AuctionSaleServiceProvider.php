<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\AuctionSale\Infrastructure\Providers;

use App\Domains\VehicleAuction\AuctionSale\Domain\Repositories\AuctionSaleDtoRepositoryInterface;
use App\Domains\VehicleAuction\AuctionSale\Domain\Repositories\AuctionSaleEntityRepositoryInterface;
use App\Domains\VehicleAuction\AuctionSale\Infrastructure\Repositories\AuctionSaleDtoRepository;
use App\Domains\VehicleAuction\AuctionSale\Infrastructure\Repositories\AuctionSaleEntityRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

final class AuctionSaleServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->scoped(
            abstract: AuctionSaleEntityRepositoryInterface::class,
            concrete: AuctionSaleEntityRepository::class,
        );

        $this->app->scoped(
            abstract: AuctionSaleDtoRepositoryInterface::class,
            concrete: AuctionSaleDtoRepository::class,
        );
    }

    public function provides(): array
    {
        return [
            AuctionSaleEntityRepositoryInterface::class,
            AuctionSaleDtoRepositoryInterface::class,
        ];
    }
}
