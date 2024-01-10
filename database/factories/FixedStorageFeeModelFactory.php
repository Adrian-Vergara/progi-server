<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domains\VehicleAuction\FixedStorageFee\Infrastructure\Models\FixedStorageFeeModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class FixedStorageFeeModelFactory extends Factory
{
    public function modelName(): string
    {
        return FixedStorageFeeModel::class;
    }

    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'amount' => $this->faker->numberBetween(1, 100),
        ];
    }

    public function setAmount(float $amount): self
    {
        return $this->state(
            fn (array $attributes) => ['amount' => $amount]
        );
    }
}
