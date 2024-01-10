<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Presentation\Http\Controllers;

use App\Domains\Common\Domain\ValueObjects\Money;
use App\Domains\VehicleAuction\CarType\Application\Actions\CalculateTotalPriceAction;
use App\Domains\VehicleAuction\CarType\Application\DataTransferObjects\CalculateTotalPriceDto;
use App\Domains\VehicleAuction\CarType\Presentation\Http\Requests\CalculateTotalPriceOfCarTypeRequest;
use Illuminate\Http\JsonResponse;

final readonly class CalculateTotalPriceController
{
    public function __construct(
        private CalculateTotalPriceAction $action,
    ) {
    }

    public function __invoke(CalculateTotalPriceOfCarTypeRequest $request): JsonResponse
    {
        return new JsonResponse([
            'data' => $this->action
                ->execute(dto: $this->fromRequestToDto($request))
                ->toArrayInSnakeCase(),
        ]);
    }

    public function fromRequestToDto(CalculateTotalPriceOfCarTypeRequest $request): CalculateTotalPriceDto
    {
        return new CalculateTotalPriceDto(
            carTypeId: $request->id,
            price: Money::fromFloat($request->price),
        );
    }
}
