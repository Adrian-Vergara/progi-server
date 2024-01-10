<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\AssociationFee\Infrastructure\Repositories;

use App\Domains\Common\Domain\ValueObjects\Money;
use App\Domains\VehicleAuction\AssociationFee\Domain\Repositories\AssociationFeeDtoRepositoryInterface;
use App\Domains\VehicleAuction\AssociationFee\Infrastructure\Models\AssociationFeeModel;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final readonly class AssociationFeeDtoRepository implements AssociationFeeDtoRepositoryInterface
{
    public function firstAssociationFeeAmountByPrice(Money $amount): Money
    {
        $callback = static fn () => throw new NotFoundHttpException(
            message: 'The price of the vehicle is not within any range of the association fee',
        );

        /** @var AssociationFeeModel $associationFeeModel */
        $associationFeeModel = AssociationFeeModel::query()
            ->where(fn (Builder $query) => $query
                ->where(column: 'from', operator: '<=', value: $amount->value())
                ->where(column: 'to', operator: '>=', value: $amount->value())
            )
            ->orWhere(fn (Builder $query) => $query
                ->where(column: 'from', operator: '<=', value: $amount->value())
                ->whereNull('to')
            )
            ->firstOr($callback);

        return Money::fromFloat(amount: $associationFeeModel->amount);
    }
}
