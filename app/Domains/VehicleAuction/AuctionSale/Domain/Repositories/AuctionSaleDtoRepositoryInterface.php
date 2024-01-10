<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\AuctionSale\Domain\Repositories;

use Illuminate\Support\Collection;

interface AuctionSaleDtoRepositoryInterface
{
    public function getAll(): Collection;
}
