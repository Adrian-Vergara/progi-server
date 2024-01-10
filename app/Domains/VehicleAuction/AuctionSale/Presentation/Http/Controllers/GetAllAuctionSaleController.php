<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\AuctionSale\Presentation\Http\Controllers;

use App\Domains\VehicleAuction\AuctionSale\Application\Queries\GetAllAuctionSaleQuery;
use App\Domains\VehicleAuction\CarType\Application\DataTransferObjects\CalculatedAmountsDto;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

final readonly class GetAllAuctionSaleController
{
    public function __construct(private GetAllAuctionSaleQuery $query)
    {
    }

    #[OA\Get(
        path: '/api/v1/auction-sales',
        description: 'Get All Auction Sales',
        tags: ['Auction Sales'],
        responses: [
            new OA\Response(
                response: JsonResponse::HTTP_OK,
                description: 'Ok',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(ref: '#/components/schemas/CalculatedAmountsResource'),
                        ),
                    ],
                    type: 'object',
                ),
            ),
            new OA\Response(
                response: JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                description: 'Internal Server Error',
            ),
        ]
    )]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([
            'data' => $this->query
                ->execute()
                ->map(fn (CalculatedAmountsDto $dto) => $dto->toArrayInSnakeCase()),
        ]);
    }
}
