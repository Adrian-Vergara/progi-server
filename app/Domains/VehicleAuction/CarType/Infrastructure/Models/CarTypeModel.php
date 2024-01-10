<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Infrastructure\Models;

use App\Domains\Common\Infrastructure\Models\AbstractModelBase;
use App\Domains\VehicleAuction\BasicUserFee\Infrastructure\Models\BasicUserFeeModel;
use App\Domains\VehicleAuction\SellerSpecialFee\Infrastructure\Models\SellerSpecialFeeModel;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string $name
 *
 * @property-read BasicUserFeeModel $basicUserFee
 * @property-read SellerSpecialFeeModel $sellerSpecialFee
 */
class CarTypeModel extends AbstractModelBase
{
    protected $table = 'car_types';

    public function basicUserFee(): HasOne
    {
        return $this->hasOne(related: BasicUserFeeModel::class, foreignKey: 'car_type_id');
    }

    public function sellerSpecialFee(): HasOne
    {
        return $this->hasOne(related: SellerSpecialFeeModel::class, foreignKey: 'car_type_id');
    }
}
