<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Presentation\Http\Controllers;

use App\Domains\Common\Domain\ValueObjects\Money;
use App\Domains\VehicleAuction\CarType\Application\Actions\CalculateTotalPriceAction;
use App\Domains\VehicleAuction\CarType\Application\DataTransferObjects\CalculateTotalPriceDto;
use App\Domains\VehicleAuction\CarType\Presentation\Http\Requests\CalculateTotalPriceOfCarTypeRequest;
use App\Domains\VehicleAuction\CarType\Presentation\Http\Resources\CalculatedAmountsResource;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

final readonly class CalculateTotalPriceController
{
    public function __construct(
        private CalculateTotalPriceAction $action,
        private CalculatedAmountsResource $resource,
    ) {
    }

    #[OA\Post(
        path: '/api/v1/car-types/{id}/calculate-total-price',
        description: 'Calculate Total Price',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/CalculateTotalPriceOfCarTypeRequest'),
        ),
        tags: ['Car Types'],
        parameters: [
            new OA\Parameter(name: 'id', description: 'Car Type ID', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(
                response: JsonResponse::HTTP_OK,
                description: 'Ok',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            ref: '#/components/schemas/CalculatedAmountsResource',
                        ),
                    ],
                    type: 'object',
                ),
            ),
            new OA\Response(
                response: JsonResponse::HTTP_NOT_FOUND,
                description: 'Car Type not found',
            ),
            new OA\Response(
                response: JsonResponse::HTTP_CONFLICT,
                description: 'The price of the vehicle is not within any range of the association fee.',
            ),
            new OA\Response(
                response: JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
                description: 'Validation Error',
            ),
            new OA\Response(
                response: JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                description: 'Internal Server Error',
            ),
        ]
    )]
    public function __invoke(CalculateTotalPriceOfCarTypeRequest $request): JsonResponse
    {
        return new JsonResponse([
            'data' => $this->resource->toArray(
                dto: $this->action->execute(dto: $this->fromRequestToDto($request))
            ),
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
