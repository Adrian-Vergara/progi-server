<?php

declare(strict_types=1);

namespace Database\Seeders;

use Database\Factories\AssociationFeeModelFactory;
use Database\Factories\FixedStorageFeeModelFactory;
use Illuminate\Database\Seeder;

class FixedStorageFeeSeeder extends Seeder
{
    public function run(): void
    {
        FixedStorageFeeModelFactory::new()
            ->setAmount(100.00)
            ->create();
    }
}
