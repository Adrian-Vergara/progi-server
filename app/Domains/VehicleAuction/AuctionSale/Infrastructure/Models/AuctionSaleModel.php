<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\AuctionSale\Infrastructure\Models;

use App\Domains\Common\Infrastructure\Models\AbstractModelBase;
use App\Domains\VehicleAuction\CarType\Infrastructure\Models\CarTypeModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $car_type_id
 * @property float $price
 * @property float $basic_user_fee
 * @property float $seller_special_fee
 * @property float $association_fee
 * @property float $fixed_storage_fee
 * @property float $total
 *
 * @property CarTypeModel $carType
 */
final class AuctionSaleModel extends AbstractModelBase
{
    protected $table = 'auction_sales';

    protected $casts = [
        'price' => 'float',
        'basic_user_fee' => 'float',
        'seller_special_fee' => 'float',
        'association_fee' => 'float',
        'fixed_storage_fee' => 'float',
        'total' => 'float',
    ];

    public function carType(): BelongsTo
    {
        return $this->belongsTo(CarTypeModel::class, 'car_type_id');
    }
}
