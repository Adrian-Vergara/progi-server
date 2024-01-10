<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\AssociationFee\Infrastructure\Providers;

use App\Domains\VehicleAuction\AssociationFee\Domain\Repositories\AssociationFeeDtoRepositoryInterface;
use App\Domains\VehicleAuction\AssociationFee\Infrastructure\Repositories\AssociationFeeDtoRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

final class AssociationFeeServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->scoped(
            abstract: AssociationFeeDtoRepositoryInterface::class,
            concrete: AssociationFeeDtoRepository::class,
        );
    }

    public function provides(): array
    {
        return [
            AssociationFeeDtoRepositoryInterface::class,
        ];
    }
}
