<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\AuctionSale\Infrastructure\Repositories;

use App\Domains\VehicleAuction\AuctionSale\Domain\Entities\AuctionSale;
use App\Domains\VehicleAuction\AuctionSale\Domain\Repositories\AuctionSaleEntityRepositoryInterface;
use App\Domains\VehicleAuction\AuctionSale\Infrastructure\Models\AuctionSaleModel;

class AuctionSaleEntityRepository implements AuctionSaleEntityRepositoryInterface
{
    public function save(AuctionSale $auctionSale): void
    {
        /** @var AuctionSaleModel $auctionSaleModel */
        $auctionSaleModel = AuctionSaleModel::query()
            ->findOrNew($auctionSale->getId()->toString());

        $auctionSaleModel->id = $auctionSale->getId()->toString();
        $auctionSaleModel->car_type_id = $auctionSale->getCarTypeId()->toString();
        $auctionSaleModel->price = $auctionSale->getPrice()->value();
        $auctionSaleModel->basic_user_fee = $auctionSale->getBasicUserFee()->value();
        $auctionSaleModel->seller_special_fee = $auctionSale->getSellerSpecialFee()->value();
        $auctionSaleModel->association_fee = $auctionSale->getAssociationFee()->value();
        $auctionSaleModel->fixed_storage_fee = $auctionSale->getFixedStorageFee()->value();
        $auctionSaleModel->total = $auctionSale->getTotal()->value();

        $auctionSaleModel->save();
    }
}
