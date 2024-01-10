<?php

declare(strict_types=1);

use App\Domains\Common\Presentation\Middlewares\MergeRouteParametersIfMissingMiddleware;
use App\Domains\VehicleAuction\AuctionSale\Presentation\Http\Controllers\CreateAuctionSaleController;
use App\Domains\VehicleAuction\AuctionSale\Presentation\Http\Controllers\GetAllAuctionSaleController;
use Illuminate\Support\Facades\Route;

Route::get(
    uri: 'v1/auction-sales',
    action: [GetAllAuctionSaleController::class, '__invoke'],
)
    ->middleware(MergeRouteParametersIfMissingMiddleware::class)
    ->name('vehicle-auction.auction-sales.get-all');

Route::post(
    uri: 'v1/car-types/{car_type_id}/auction-sales',
    action: [CreateAuctionSaleController::class, '__invoke'],
)
    ->middleware(MergeRouteParametersIfMissingMiddleware::class)
    ->name('vehicle-auction.auction-sales.create');
