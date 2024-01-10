<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Presentation\Http\Controllers;

use App\Domains\VehicleAuction\CarType\Application\Actions\CreateCarTypeAction;
use App\Domains\VehicleAuction\CarType\Application\DataTransferObjects\ModifyCarTypeDto;
use App\Domains\VehicleAuction\CarType\Presentation\Http\Requests\CreateCarTypeRequest;
use Illuminate\Http\JsonResponse;
use Ramsey\Uuid\UuidFactory;

final readonly class CreateCarTypeController
{
    public function __construct(
        private UuidFactory $uuidFactory,
        private CreateCarTypeAction $action,
    ) {
    }

    public function __invoke(
        CreateCarTypeRequest $request,
    ): JsonResponse {
        $this->action->execute(
            dto: $dto = $this->fromRequestToDto($request),
        );

        return new JsonResponse([
            'message' => sprintf('%s successfully created', $request->name),
            'data' => [
                'id' => $dto->id,
            ],
        ], JsonResponse::HTTP_CREATED);
    }

    private function fromRequestToDto(CreateCarTypeRequest $request): ModifyCarTypeDto
    {
        return new ModifyCarTypeDto(
            id: $this->uuidFactory->uuid4()->toString(),
            name: $request->name,
        );
    }
}
