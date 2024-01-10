<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Domain\ValueObjects;

use InvalidArgumentException;

final readonly class CarTypeName
{
    public function __construct(
        private string $name,
    ) {
        $this->validate();
    }

    public function value(): string
    {
        return $this->name;
    }

    public static function fromString(string $name): self
    {
        return new self($name);
    }

    private function validate(): void
    {
        $hasIncorrectLength = strlen($this->name) < 3 || strlen($this->name) > 150;

        throw_if(
            condition: $hasIncorrectLength,
            exception: InvalidArgumentException::class,
            parameters: 'The name must be more than 3 and less than 150 characters.',
        );
    }
}
