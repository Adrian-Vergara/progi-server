<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domains\VehicleAuction\SellerSpecialFee\Infrastructure\Models\SellerSpecialFeeModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class SellerSpecialFeeModelFactory extends Factory
{
    public function modelName(): string
    {
        return SellerSpecialFeeModel::class;
    }

    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'percentage' => $this->faker->numberBetween(1, 10),
        ];
    }

    public function setPercentage(int $percentage): self
    {
        return $this->state(
            fn (array $attributes) => ['percentage' => $percentage]
        );
    }

    public function setCarTypeId(string $carTypeId): self
    {
        return $this->state(
            fn (array $attributes) => ['car_type_id' => $carTypeId]
        );
    }
}
