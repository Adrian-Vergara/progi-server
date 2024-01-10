<?php

namespace Tests\Traits;

use App\Domains\VehicleAuction\CarType\Infrastructure\Models\CarTypeModel;
use App\Domains\VehicleAuction\FixedStorageFee\Infrastructure\Models\FixedStorageFeeModel;
use Database\Factories\AssociationFeeModelFactory;
use Database\Factories\BasicUserFeeModelFactory;
use Database\Factories\CarTypeModelFactory;
use Database\Factories\FixedStorageFeeModelFactory;
use Database\Factories\SellerSpecialFeeModelFactory;
use Illuminate\Support\Collection;

trait WithDefaultData
{
    private CarTypeModel $common;
    private CarTypeModel $luxury;
    private FixedStorageFeeModel $fixedStorageFee;
    private Collection $associationFees;

    private array $carTypes = [
        'Common' => [
            'basic_user_fee' => [
                'percentage' => 10,
                'minimum' => 10.00,
                'maximum' => 50.00,
            ],
            'seller_special_fee' => [
                'percentage' => 2,
            ],
        ],
        'Luxury' => [
            'basic_user_fee' => [
                'percentage' => 10,
                'minimum' => 25.00,
                'maximum' => 200.00,
            ],
            'seller_special_fee' => [
                'percentage' => 4,
            ],
        ]
    ];

    private function createDefaultData(): void
    {
        $this->createCarTypes();

        $this->createAssociationFee();

        $this->createFixedStorageFee();
    }

    private function createCarTypes(): void
    {
        $carTypes = new Collection(
            array_keys($this->carTypes)
        );

        $carTypes->each(fn (string $carTypeName) => $this->addCarType(name: $carTypeName));
    }

    private function addCarType(string $name): void
    {
        $carTypeModel = CarTypeModelFactory::new()
            ->setName(name: $name)
            ->create();

        $this->addBasicUserFee(carTypeModel: $carTypeModel);

        $this->addSellerSpecialFee(carTypeModel: $carTypeModel);

        if ('Common' === $name) {
            $this->common = $carTypeModel;
        }

        if ('Luxury' === $name) {
            $this->luxury = $carTypeModel;
        }
    }

    private function addBasicUserFee(CarTypeModel $carTypeModel): void
    {
        $basicUserFee = $this->carTypes[$carTypeModel->name]['basic_user_fee'];

        BasicUserFeeModelFactory::new()
            ->setCarTypeId($carTypeModel->getKey())
            ->setPercentage($basicUserFee['percentage'])
            ->setMinimumValue($basicUserFee['minimum'])
            ->setMaximumValue($basicUserFee['maximum'])
            ->create();
    }

    private function addSellerSpecialFee(CarTypeModel $carTypeModel): void
    {
        $sellerSpecialFee = $this->carTypes[$carTypeModel->name]['seller_special_fee'];

        SellerSpecialFeeModelFactory::new()
            ->setCarTypeId($carTypeModel->getKey())
            ->setPercentage($sellerSpecialFee['percentage'])
            ->create();
    }

    private function createAssociationFee(): void
    {
        $this->associationFees = (new Collection([
            [
                'from' => 1.00,
                'to' => 500.00,
                'amount' => 5.00,
            ],
            [
                'from' => 500.01,
                'to' => 1000,
                'amount' => 10.00,
            ],
            [
                'from' => 1000.01,
                'to' => 3000,
                'amount' => 15.00,
            ],
            [
                'from' => 3000.01,
                'to' => null,
                'amount' => 20.00,
            ],
        ]))
            ->each($this->addAssociationFee(...));
    }

    private function addAssociationFee(array $associationFee): void
    {
        AssociationFeeModelFactory::new()
            ->setFrom($associationFee['from'])
            ->setTo($associationFee['to'])
            ->setAmount($associationFee['amount'])
            ->create();
    }

    private function createFixedStorageFee(): void
    {
        $this->fixedStorageFee = FixedStorageFeeModelFactory::new()
            ->setAmount(100.00)
            ->create();
    }
}
