<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Application\Actions;

use App\Domains\Common\Domain\ValueObjects\Money;
use App\Domains\VehicleAuction\AssociationFee\Domain\Repositories\AssociationFeeDtoRepositoryInterface;
use App\Domains\VehicleAuction\CarType\Application\DataTransferObjects\CalculatedAmountsDto;
use App\Domains\VehicleAuction\CarType\Application\DataTransferObjects\CalculateTotalPriceDto;
use App\Domains\VehicleAuction\CarType\Application\DataTransferObjects\CarTypeDto;
use App\Domains\VehicleAuction\CarType\Application\DataTransferObjects\CarTypeWithBasicUserAndSellerSpecialFeeDto;
use App\Domains\VehicleAuction\CarType\Domain\Repositories\CarTypeDtoRepositoryInterface;
use App\Domains\VehicleAuction\FixedStorageFee\Domain\Repositories\FixedStorageFeeDtoRepositoryInterface;

final class CalculateTotalPriceAction
{
    private CalculateTotalPriceDto $dto;
    private CarTypeWithBasicUserAndSellerSpecialFeeDto $carType;

    public function __construct(
        private readonly CarTypeDtoRepositoryInterface $repository,
        private readonly FixedStorageFeeDtoRepositoryInterface $fixedStorageFeeDtoRepository,
        private readonly AssociationFeeDtoRepositoryInterface $associationFeeDtoRepository,
    ) {
    }

    public function execute(CalculateTotalPriceDto $dto): CalculatedAmountsDto
    {
        $this->dto = $dto;

        $this->carType = $this->repository->findByIdWithBasicUserAndSellerSpecialFee(id: $dto->carTypeId);

        $basicUserFeeValue = $this->calculateBasicUserFeeValue();

        $sellerSpecialFeeValue = $dto->price->calculatePercentage($this->carType->sellerSpecialFee->percentage);

        $fixedStorageFeeValue = $this->fixedStorageFeeDtoRepository->first()->amount;

        $associationFeeValue = $this->associationFeeDtoRepository->firstAssociationFeeAmountByPrice($dto->price);

        return new CalculatedAmountsDto(
            carType: new CarTypeDto(
                id: $this->carType->id,
                name: $this->carType->name
            ),
            price: $dto->price,
            basicUserFee: $basicUserFeeValue,
            sellerSpecialFee: $sellerSpecialFeeValue,
            associationFee: $associationFeeValue,
            fixedStorageFee: $fixedStorageFeeValue,
        );
    }

    private function calculateBasicUserFeeValue(): Money
    {
        $basicUserFee = $this->carType->basicUserFee;

        $value = $this->dto->price->calculatePercentage($basicUserFee->percentage);

        if ($value->isLessThan($basicUserFee->minimumValue)) {
            return Money::fromFloat($basicUserFee->minimumValue);
        }

        if ($value->isGreaterThan($basicUserFee->maximumValue)) {
            return Money::fromFloat($basicUserFee->maximumValue);
        }

        return $value;
    }
}
