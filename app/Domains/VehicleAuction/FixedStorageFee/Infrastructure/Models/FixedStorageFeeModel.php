<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\FixedStorageFee\Infrastructure\Models;

use App\Domains\Common\Infrastructure\Models\AbstractModelBase;

/**
 * @property float $amount
 */
class FixedStorageFeeModel extends AbstractModelBase
{
    protected $table = 'fixed_storage_fees';

    protected $casts = [
        'amount' => 'float',
    ];
}
