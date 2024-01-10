<?php

namespace App\Domains\VehicleAuction\AuctionSale\Domain\Repositories;

use App\Domains\VehicleAuction\AuctionSale\Domain\Entities\AuctionSale;

interface AuctionSaleEntityRepositoryInterface
{
    public function save(AuctionSale $auctionSale): void;
}
