<?php

declare(strict_types=1);

namespace Tests\Feature\CarType;

use App\Domains\VehicleAuction\CarType\Infrastructure\Models\CarTypeModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\RequestFactories\CalculateOrCreateAuctionSaleRequest;
use Tests\TestCase;
use Tests\Traits\WithCalculateDataLogic;
use Tests\Traits\WithDefaultData;

class CalculateTotalPriceControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker, WithDefaultData, WithCalculateDataLogic;

    protected function setUp(): void
    {
        parent::setUp();

        $this->createDefaultData();
    }

    /** @dataProvider manualTestsForCommonVehicleProvider */
    public function testShouldReturnOkWhenCalculatingManuallyForCommonVehicleType(
        float $price,
        float $basicFee,
        float $specialFee,
        float $associationFee,
        float $fixedFee,
        float $total,
    ): void
    {
        $payload = $this->arrangeASpecificPrice($price);

        $response = $this->executeApi($this->common->getKey(), $payload);

        $response
            ->assertOk()
            ->assertJsonFragment([
                'data' => [
                    'association_fee' => $associationFee,
                    'basic_user_fee' => $basicFee,
                    'car_type' => [
                        'id' => $this->common->getKey(),
                        'name' => $this->common->name,
                    ],
                    'fixed_storage_fee' => $fixedFee,
                    'price' => $price,
                    'seller_special_fee' => $specialFee,
                    'total' => $total,
                ]
            ]);
    }

    /** @dataProvider manualTestsForLuxuryVehicleProvider */
    public function testShouldReturnOkWhenCalculatingManuallyForLuxuryVehicleType(
        float $price,
        float $basicFee,
        float $specialFee,
        float $associationFee,
        float $fixedFee,
        float $total,
    ): void {
        $payload = $this->arrangeASpecificPrice($price);

        $response = $this->executeApi($this->luxury->getKey(), $payload);

        $response
            ->assertOk()
            ->assertJsonFragment([
                'data' => [
                    'association_fee' => $associationFee,
                    'basic_user_fee' => $basicFee,
                    'car_type' => [
                        'id' => $this->luxury->getKey(),
                        'name' => $this->luxury->name,
                    ],
                    'fixed_storage_fee' => $fixedFee,
                    'price' => $price,
                    'seller_special_fee' => $specialFee,
                    'total' => $total,
                ]
            ]);
    }

    /** @dataProvider manualTestsForCommonVehicleWithDecimalsProvider */
    public function testShouldReturnOkWhenCalculatingManuallyWithDecimalPricesForCommonVehicleType(float $price): void
    {
        $payload = $this->arrangeASpecificPrice($price);

        $response = $this->executeApi($this->common->getKey(), $payload);

        $this->assertSuccessData(
            response: $response,
            carTypeModel: $this->common,
            price: $price,
        );
    }

    /** @dataProvider manualTestsForLuxuryVehicleWithDecimalsProvider */
    public function testShouldReturnOkWhenCalculatingManuallyWithDecimalPricesForLuxuryVehicleType(float $price): void
    {
        $payload = $this->arrangeASpecificPrice($price);

        $response = $this->executeApi($this->luxury->getKey(), $payload);

        $this->assertSuccessData(
            response: $response,
            carTypeModel: $this->luxury,
            price: $price,
        );
    }

    private function arrangeACorrectPayload(): array
    {
        return CalculateOrCreateAuctionSaleRequest::new()
            ->setPrice(398)
            ->prepare();
    }

    private function arrangeASpecificPrice(float $price): array
    {
        return CalculateOrCreateAuctionSaleRequest::new()
            ->setPrice($price)
            ->prepare();
    }

    private function executeApi(string $carTypeId, array $payload): TestResponse
    {
        return $this->postJson(
            uri: route(
                name: 'vehicle-auction.car-types.calculate',
                parameters: ['id' => $carTypeId],
            ),
            data: $payload,
        );
    }

    private function assertSuccessData(TestResponse $response, CarTypeModel $carTypeModel, float $price): void
    {
        $response
            ->assertOk()
            ->assertJsonFragment([
                'data' => $this->buildDataToAssert(carTypeModel: $carTypeModel, price: $price),
            ]);
    }

    private function buildDataToAssert(CarTypeModel $carTypeModel, float $price): array
    {
        return [
            'association_fee' => $associationFee = $this->calculateAssociationFee($this->associationFees, $price),
            'basic_user_fee' => $basicFee = $this->calculateBasicUserFee($carTypeModel, $price),
            'car_type' => [
                'id' => $carTypeModel->getKey(),
                'name' => $carTypeModel->name,
            ],
            'fixed_storage_fee' => $this->fixedStorageFee->amount,
            'price' => $price,
            'seller_special_fee' => $specialFee = $this->calculateSellerSpecialFee($carTypeModel, $price),
            'total' => $this->roundUpToTwoDecimals(
                $price + $basicFee + $specialFee + $associationFee + $this->fixedStorageFee->amount
            ),
        ];
    }

    public static function manualTestsForCommonVehicleProvider(): array
    {
        return [
            'Common vehicle type with price for $398.00' => [
                398.00,
                39.80,
                7.96,
                5.00,
                100.00,
                550.76,
            ],
            'Common vehicle type with price for $501.00' => [
                501.00,
                50.00,
                10.02,
                10.00,
                100.00,
                671.02,
            ],
            'Common vehicle type with price for $57.00' => [
                57.00,
                10.00,
                1.14,
                5.00,
                100.00,
                173.14,
            ],
            'Common vehicle type with price for $1,100.00' => [
                1100.00,
                50.00,
                22.00,
                15.00,
                100.00,
                1287.00,
            ],
        ];
    }

    public static function manualTestsForLuxuryVehicleProvider(): array
    {
        return [
            'Luxury vehicle type with price for $1,800.00' => [
                1800.00,
                180.00,
                72.00,
                15.00,
                100.00,
                2167.00,
            ],
            'Luxury vehicle type with price for $1,000,000.00' => [
                1000000.00,
                200.00,
                40000.00,
                20.00,
                100.00,
                1040320.00,
            ],
        ];
    }

    public static function manualTestsForCommonVehicleWithDecimalsProvider(): array
    {
        return [
            'Common vehicle type with price for $150,000.01' => [
                150000.01,
            ],
            'Common vehicle type with price for $548.49' => [
                548.49,
            ],
            'Common vehicle type with price for $215367.76' => [
                215367.76,
            ],
            'Common vehicle type with price for $999999999.99' => [
                999999999.99,
            ],
        ];
    }

    public static function manualTestsForLuxuryVehicleWithDecimalsProvider(): array
    {
        return [
            'Luxury vehicle type with price for $150,000.01' => [
                150000.01,
            ],
            'Luxury vehicle type with price for $548.49' => [
                548.49,
            ],
            'Luxury vehicle type with price for $215367.76' => [
                215367.76,
            ],
            'Luxury vehicle type with price for $999999999.99' => [
                999999999.99,
            ],
        ];
    }
}
