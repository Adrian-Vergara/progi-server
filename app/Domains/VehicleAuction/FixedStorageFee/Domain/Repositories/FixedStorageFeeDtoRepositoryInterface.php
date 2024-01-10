<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\FixedStorageFee\Domain\Repositories;

use App\Domains\VehicleAuction\FixedStorageFee\Application\DataTransferObjects\FixedStorageFeeDto;

interface FixedStorageFeeDtoRepositoryInterface
{
    public function first(): FixedStorageFeeDto;
}
