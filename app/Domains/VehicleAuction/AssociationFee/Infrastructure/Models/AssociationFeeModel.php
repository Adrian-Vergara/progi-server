<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\AssociationFee\Infrastructure\Models;

use App\Domains\Common\Infrastructure\Models\AbstractModelBase;

/**
 * @property float $from
 * @property ?float $to
 * @property float $amount
 */
class AssociationFeeModel extends AbstractModelBase
{
    protected $table = 'association_fees';

    protected $casts = [
        'from' => 'float',
        'to' => 'float',
        'amount' => 'float',
    ];
}
