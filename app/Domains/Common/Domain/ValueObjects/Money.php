<?php

declare(strict_types=1);

namespace App\Domains\Common\Domain\ValueObjects;

use InvalidArgumentException;

final class Money
{
    final public function __construct(private float $amount)
    {
        $this->validate();
    }

    public function value(): float
    {
        return $this->amount;
    }

    public function calculatePercentage(float $percentage): Money
    {
        return new self($this->amount * $percentage / 100);
    }

    public function isLessThan(float $value): bool
    {
        return $this->amount < $value;
    }

    public function isGreaterThan(float $value): bool
    {
        return $this->amount > $value;
    }

    public function sum(Money ...$amounts): self
    {
        $totalAmount = $this->value();

        foreach ($amounts as $amount) {
            $totalAmount += $amount->value();
        }

        return new Money($totalAmount);
    }

    public static function fromFloat(float $amount): self
    {
        return new self($amount);
    }

    private function validate(): void
    {
        $this->roundUpToTwoDecimals();

        if ($this->amount > 0.00) {
            return;
        }

        throw new InvalidArgumentException('the amount must be greater than zero');
    }

    private function roundUpToTwoDecimals(): void
    {
        $this->amount = round($this->amount, 2);
    }
}
