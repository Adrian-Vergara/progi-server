<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Domains\VehicleAuction\CarType\Infrastructure\Models\CarTypeModel;
use Database\Factories\BasicUserFeeModelFactory;
use Database\Factories\CarTypeModelFactory;
use Database\Factories\SellerSpecialFeeModelFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class CarTypeSeeder extends Seeder
{
    const CAR_TYPES = [
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

    public function run(): void
    {
        $carTypes = new Collection(
            array_keys(self::CAR_TYPES)
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
    }

    private function addBasicUserFee(CarTypeModel $carTypeModel): void
    {
        $basicUserFee = self::CAR_TYPES[$carTypeModel->name]['basic_user_fee'];

        BasicUserFeeModelFactory::new()
            ->setCarTypeId($carTypeModel->getKey())
            ->setPercentage($basicUserFee['percentage'])
            ->setMinimumValue($basicUserFee['minimum'])
            ->setMaximumValue($basicUserFee['maximum'])
            ->create();
    }

    private function addSellerSpecialFee(CarTypeModel $carTypeModel): void
    {
        $sellerSpecialFee = self::CAR_TYPES[$carTypeModel->name]['seller_special_fee'];

        SellerSpecialFeeModelFactory::new()
            ->setCarTypeId($carTypeModel->getKey())
            ->setPercentage($sellerSpecialFee['percentage'])
            ->create();
    }
}
