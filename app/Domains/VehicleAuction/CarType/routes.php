<?php

declare(strict_types=1);

use App\Domains\Common\Presentation\Middlewares\MergeRouteParametersIfMissingMiddleware;
use App\Domains\VehicleAuction\CarType\Presentation\Http\Controllers\CalculateTotalPriceController;
use App\Domains\VehicleAuction\CarType\Presentation\Http\Controllers\CreateCarTypeController;
use App\Domains\VehicleAuction\CarType\Presentation\Http\Controllers\GetAllCarTypeController;
use Illuminate\Support\Facades\Route;

Route::get(
    uri: 'v1/car-types',
    action: [GetAllCarTypeController::class, '__invoke'],
)
    ->name('vehicle-auction.car-types.all');

Route::post(
    uri: 'v1/car-types',
    action: [CreateCarTypeController::class, '__invoke'],
)
    ->name('vehicle-auction.car-types.create');

Route::post(
    uri: 'v1/car-types/{id}/calculate-total-price',
    action: [CalculateTotalPriceController::class, '__invoke'],
)
    ->middleware(MergeRouteParametersIfMissingMiddleware::class)
    ->name('vehicle-auction.car-types.calculate');
