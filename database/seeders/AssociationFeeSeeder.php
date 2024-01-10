<?php

declare(strict_types=1);

namespace Database\Seeders;

use Database\Factories\AssociationFeeModelFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class AssociationFeeSeeder extends Seeder
{
    public function run(): void
    {
        (new Collection([
            [
                'from' => 1.00,
                'to' => 500.00,
                'amount' => 5.00,
            ],
            [
                'from' => 500.01,
                'to' => 1000,
                'amount' => 10.00,
            ],
            [
                'from' => 1000.01,
                'to' => 3000,
                'amount' => 15.00,
            ],
            [
                'from' => 3000.01,
                'to' => null,
                'amount' => 20.00,
            ],
        ]))
            ->each($this->addAssociationFee(...));
    }

    private function addAssociationFee(array $associationFee): void
    {
        AssociationFeeModelFactory::new()
            ->setFrom($associationFee['from'])
            ->setTo($associationFee['to'])
            ->setAmount($associationFee['amount'])
            ->create();
    }
}
