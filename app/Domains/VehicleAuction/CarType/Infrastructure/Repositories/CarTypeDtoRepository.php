<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Infrastructure\Repositories;

use App\Domains\VehicleAuction\BasicUserFee\Application\DataTransferObjects\BasicUserFeeDto;
use App\Domains\VehicleAuction\CarType\Application\DataTransferObjects\CarTypeDto;
use App\Domains\VehicleAuction\CarType\Application\DataTransferObjects\CarTypeWithBasicUserAndSellerSpecialFeeDto;
use App\Domains\VehicleAuction\CarType\Domain\Repositories\CarTypeDtoRepositoryInterface;
use App\Domains\VehicleAuction\CarType\Infrastructure\Models\CarTypeModel;
use App\Domains\VehicleAuction\SellerSpecialFee\Application\DataTransferObjects\SellerSpecialFeeDto;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final readonly class CarTypeDtoRepository implements CarTypeDtoRepositoryInterface
{
    /** @return Collection<int,CarTypeDto> */
    public function getAll(): Collection
    {
        return CarTypeModel::query()
            ->orderBy('name')
            ->get()
            ->map($this->mapToCarTypeDto(...));
    }

    public function findByIdWithBasicUserAndSellerSpecialFee(string $id): CarTypeWithBasicUserAndSellerSpecialFeeDto
    {
        $callback = static fn () => throw new NotFoundHttpException(
            message: sprintf('Car Type with id %s not found.', $id),
        );

        /** @var CarTypeModel $carType */
        $carType = CarTypeModel::with('basicUserFee', 'sellerSpecialFee')
            ->findOr(id: $id, callback: $callback);

        return new CarTypeWithBasicUserAndSellerSpecialFeeDto(
            id: $carType->getKey(),
            name: $carType->name,
            basicUserFee: new BasicUserFeeDto(
                id: $carType->basicUserFee->getKey(),
                carTypeId: $carType->getKey(),
                percentage: $carType->basicUserFee->percentage,
                minimumValue: $carType->basicUserFee->minimum_value,
                maximumValue: $carType->basicUserFee->maximum_value,
            ),
            sellerSpecialFee: new SellerSpecialFeeDto(
                id: $carType->sellerSpecialFee->id,
                carTypeId: $carType->getKey(),
                percentage: $carType->sellerSpecialFee->percentage,
            ),
        );
    }

    private function mapToCarTypeDto(CarTypeModel $carTypeModel): CarTypeDto
    {
        return new CarTypeDto(
            id: $carTypeModel->getKey(),
            name: $carTypeModel->name,
        );
    }
}
