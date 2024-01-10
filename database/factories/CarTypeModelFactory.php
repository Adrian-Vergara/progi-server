<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domains\VehicleAuction\CarType\Infrastructure\Models\CarTypeModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class CarTypeModelFactory extends Factory
{
    public function modelName(): string
    {
        return CarTypeModel::class;
    }

    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'name' => $this->faker->name,
        ];
    }

    public function setName(string $name): self
    {
        return $this->state(
            fn (array $attributes) => ['name' => $name]
        );
    }
}
