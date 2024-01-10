<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\AuctionSale\Presentation\Http\Controllers;

use App\Domains\Common\Domain\ValueObjects\Money;
use App\Domains\VehicleAuction\AuctionSale\Application\Actions\CreateSaleAuctionAction;
use App\Domains\VehicleAuction\AuctionSale\Application\DataTransferObjects\CreateAuctionSaleDto;
use App\Domains\VehicleAuction\AuctionSale\Presentation\Http\Requests\CreateAuctionSaleRequest;
use Illuminate\Http\JsonResponse;
use Ramsey\Uuid\UuidFactory;
use OpenApi\Attributes as OA;

final readonly class CreateAuctionSaleController
{
    public function __construct(
        private UuidFactory $uuidFactory,
        private CreateSaleAuctionAction $action,
    ) {
    }

    #[OA\Post(
        path: '/api/v1/car-types/{car_type_id}/auction-sales',
        description: 'Create an Auction Sale',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/CreateAuctionSaleRequest'),
        ),
        tags: ['Auction Sales'],
        parameters: [
            new OA\Parameter(name: 'car_type_id', description: 'Car Type ID', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(
                response: JsonResponse::HTTP_CREATED,
                description: 'Created',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            properties: [
                                new OA\Property(
                                    property: 'id',
                                    type: 'string',
                                )
                            ],
                            type: 'object' ,
                        ),
                        new OA\Property(
                            property: 'message',
                            type: 'string',
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
    public function __invoke(CreateAuctionSaleRequest $request): JsonResponse
    {
        $this->action->execute(
            dto: $dto = $this->fromRequestToDto($request),
        );

        return new JsonResponse([
            'message' => 'Auction Sale successfully registered.',
            'data' => [
                'id' => $dto->id,
            ],
        ], JsonResponse::HTTP_CREATED);
    }

    private function fromRequestToDto(CreateAuctionSaleRequest $request): CreateAuctionSaleDto
    {
        return new CreateAuctionSaleDto(
            id: $this->uuidFactory->uuid4()->toString(),
            carTypeId: $request->carTypeId,
            price: Money::fromFloat($request->price),
        );
    }
}
