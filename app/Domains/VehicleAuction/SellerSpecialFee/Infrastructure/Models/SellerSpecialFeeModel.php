<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\SellerSpecialFee\Infrastructure\Models;

use App\Domains\Common\Infrastructure\Models\AbstractModelBase;

/**
 * @property string $car_type_id
 * @property int $percentage
 */
class SellerSpecialFeeModel extends AbstractModelBase
{
    protected $table = 'seller_special_fees';
}
