<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Domain\Repositories;

use App\Domains\VehicleAuction\CarType\Application\DataTransferObjects\CarTypeWithBasicUserAndSellerSpecialFeeDto;
use Illuminate\Support\Collection;

interface CarTypeDtoRepositoryInterface
{
    public function getAll(): Collection;

    public function findByIdWithBasicUserAndSellerSpecialFee(string $id): CarTypeWithBasicUserAndSellerSpecialFeeDto;
}
