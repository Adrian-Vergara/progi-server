<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\BasicUserFee\Infrastructure\Models;

use App\Domains\Common\Infrastructure\Models\AbstractModelBase;

/**
 * @property string $car_type_id
 * @property int $percentage
 * @property float $minimum_value
 * @property float $maximum_value
 */
class BasicUserFeeModel extends AbstractModelBase
{
    protected $table = 'basic_user_fees';

    protected $casts = [
        'minimum_value' => 'float',
        'maximum_value' => 'float',
    ];
}
