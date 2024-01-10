<?php

declare(strict_types=1);

namespace Tests\Traits;

use App\Domains\VehicleAuction\CarType\Infrastructure\Models\CarTypeModel;
use Illuminate\Support\Collection;

trait WithCalculateDataLogic
{
    private function calculateBasicUserFee(CarTypeModel $carTypeModel, float $price): float
    {
        $basicUserFee = $carTypeModel->basicUserFee;

        $value = $this->roundUpToTwoDecimals(
            ($price * $basicUserFee->percentage) / 100
        );

        if ($value < $basicUserFee->minimum_value) {
            return $basicUserFee->minimum_value;
        }

        if ($value > $basicUserFee->maximum_value) {
            return $basicUserFee->maximum_value;
        }

        return $value;
    }

    private function calculateSellerSpecialFee(CarTypeModel $carTypeModel, float $price): float
    {
        $sellerSpecialFee = $carTypeModel->sellerSpecialFee;

        return $this->roundUpToTwoDecimals(
            ($price * $sellerSpecialFee->percentage) / 100
        );
    }

    private function calculateAssociationFee(Collection $associationFees, float $price): float
    {
        $associationFee = $associationFees
            ->where(key: 'from', operator: '<=', value: $price)
            ->where(key: 'to', operator: '>=', value: $price)
            ->first();

        if (null !== $associationFee) {
            return $associationFee['amount'];
        }

        $associationFee = $associationFees
            ->where(key: 'from', operator: '<=', value: $price)
            ->whereNull(key: 'to')
            ->first();

        return $associationFee['amount'];
    }

    private function roundUpToTwoDecimals($amount): float
    {
        return round($amount, 2);
    }
}
