<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domains\VehicleAuction\AssociationFee\Infrastructure\Models\AssociationFeeModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssociationFeeModelFactory extends Factory
{
    public function modelName(): string
    {
        return AssociationFeeModel::class;
    }

    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
        ];
    }

    public function setFrom(float $from): self
    {
        return $this->state(
            fn (array $attributes) => ['from' => $from]
        );
    }

    public function setTo(?float $to): self
    {
        return $this->state(
            fn (array $attributes) => ['to' => $to]
        );
    }

    public function setAmount(float $to): self
    {
        return $this->state(
            fn (array $attributes) => ['amount' => $to]
        );
    }
}
