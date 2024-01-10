<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Presentation\Http\Requests;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;

final class CreateCarTypeRequest extends Data
{
    public function __construct(
        #[Min(3), Max(150)]
        public readonly string $name,
    ) {
    }
}
