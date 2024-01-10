<?php

declare(strict_types=1);

namespace Tests\RequestFactories;

class CalculateOrCreateAuctionSaleRequest extends AbstractRequestFactory
{
    public function definition(): array
    {
        return [
            'price' => $this->faker->numberBetween(100, 200000),
        ];
    }

    public function setPrice(mixed $price): self
    {
        $this->attributes['price'] = $price;

        return $this;
    }
}
