<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domains\VehicleAuction\BasicUserFee\Infrastructure\Models\BasicUserFeeModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class BasicUserFeeModelFactory extends Factory
{
    public function modelName(): string
    {
        return BasicUserFeeModel::class;
    }

    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'percentage' => $this->faker->numberBetween(1, 10),
        ];
    }

    public function setCarTypeId(string $carTypeId): self
    {
        return $this->state(
            fn (array $attributes) => ['car_type_id' => $carTypeId]
        );
    }

    public function setPercentage(int $percentage): self
    {
        return $this->state(
            fn (array $attributes) => ['percentage' => $percentage]
        );
    }

    public function setMinimumValue(float $minimumValue): self
    {
        return $this->state(
            fn (array $attributes) => ['minimum_value' => $minimumValue]
        );
    }

    public function setMaximumValue(float $maximumValue): self
    {
        return $this->state(
            fn (array $attributes) => ['maximum_value' => $maximumValue]
        );
    }
}
