<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\AuctionSale\Presentation\Http\Controllers;

use App\Domains\VehicleAuction\AuctionSale\Application\Queries\GetAllAuctionSaleQuery;
use App\Domains\VehicleAuction\CarType\Application\DataTransferObjects\CalculatedAmountsDto;
use Illuminate\Http\JsonResponse;

final readonly class GetAllAuctionSaleController
{
    public function __construct(private GetAllAuctionSaleQuery $query)
    {
    }

    public function __invoke(): JsonResponse
    {
        return new JsonResponse([
            'data' => $this->query
                ->execute()
                ->map(fn (CalculatedAmountsDto $dto) => $dto->toArrayInSnakeCase()),
        ]);
    }
}
