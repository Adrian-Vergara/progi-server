<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\AssociationFee\Domain\Repositories;

use App\Domains\Common\Domain\ValueObjects\Money;

interface AssociationFeeDtoRepositoryInterface
{
    public function firstAssociationFeeAmountByPrice(Money $amount): Money;
}
