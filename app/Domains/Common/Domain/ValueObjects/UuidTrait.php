<?php

declare(strict_types=1);

namespace App\Domains\Common\Domain\ValueObjects;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

trait UuidTrait
{
    private readonly UuidInterface $id;

    final public function __construct(?string $id = null)
    {
        $this->id = null !== $id ? Uuid::fromString($id) : Uuid::uuid4();
    }

    public function __toString(): string
    {
        return $this->id->toString();
    }

    public static function fromId(?string $id): static
    {
        return new static((string) $id);
    }

    public function equals(mixed $subject): bool
    {
        if (method_exists($subject, 'id') && $subject->id() instanceof UuidInterface) {
            return $this->id->equals($subject->id());
        }

        return false;
    }

    public function id(): UuidInterface
    {
        return $this->id;
    }

    public function toString(): string
    {
        return $this->id->toString();
    }
}

