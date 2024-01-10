<?php

declare(strict_types=1);

namespace Tests\RequestFactories;

use Illuminate\Foundation\Testing\WithFaker;

abstract class AbstractRequestFactory
{
    use WithFaker;

    protected array $attributes;

    public function __construct()
    {
        $this->setUpFaker();
        $this->attributes = $this->definition();
    }

    public static function new(): static
    {
        return new static();
    }

    abstract public function definition(): array;

    public function prepare(): array
    {
        return $this->attributes;
    }
}
