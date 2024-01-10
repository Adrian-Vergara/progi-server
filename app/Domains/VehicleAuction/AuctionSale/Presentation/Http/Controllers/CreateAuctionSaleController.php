<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\AuctionSale\Presentation\Http\Controllers;

use App\Domains\Common\Domain\ValueObjects\Money;
use App\Domains\VehicleAuction\AuctionSale\Application\Actions\CreateSaleAuctionAction;
use App\Domains\VehicleAuction\AuctionSale\Application\DataTransferObjects\CreateAuctionSaleDto;
use App\Domains\VehicleAuction\AuctionSale\Presentation\Http\Requests\CreateAuctionSaleRequest;
use Illuminate\Http\JsonResponse;
use Ramsey\Uuid\UuidFactory;

final readonly class CreateAuctionSaleController
{
    public function __construct(
        private UuidFactory $uuidFactory,
        private CreateSaleAuctionAction $action,
    ) {
    }

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
