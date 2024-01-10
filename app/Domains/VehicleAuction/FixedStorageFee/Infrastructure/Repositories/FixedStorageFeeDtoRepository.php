<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\FixedStorageFee\Infrastructure\Repositories;

use App\Domains\Common\Domain\ValueObjects\Money;
use App\Domains\VehicleAuction\FixedStorageFee\Application\DataTransferObjects\FixedStorageFeeDto;
use App\Domains\VehicleAuction\FixedStorageFee\Domain\Repositories\FixedStorageFeeDtoRepositoryInterface;
use App\Domains\VehicleAuction\FixedStorageFee\Infrastructure\Models\FixedStorageFeeModel;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final readonly class FixedStorageFeeDtoRepository implements FixedStorageFeeDtoRepositoryInterface
{
    public function first(): FixedStorageFeeDto
    {
        $callback = static fn () => throw new NotFoundHttpException(
            message: 'There is no fixed storage fee registered',
        );

        /** @var FixedStorageFeeModel $fixedStorageFee */
        $fixedStorageFee = FixedStorageFeeModel::query()
            ->firstOr($callback);

        return new FixedStorageFeeDto(
            id: $fixedStorageFee->getKey(),
            amount: Money::fromFloat($fixedStorageFee->amount),
        );
    }
}
