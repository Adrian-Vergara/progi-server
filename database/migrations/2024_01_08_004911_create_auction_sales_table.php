<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('auction_sales', function (Blueprint $table) {
            $table->char('id', 36)->primary();

            $table->char('car_type_id', 36);
            $table->unsignedDecimal('price', 16, 2);
            $table->unsignedDecimal('basic_user_fee', 5, 2);
            $table->unsignedDecimal('seller_special_fee', 16, 2);
            $table->unsignedDecimal('association_fee', 5, 2);
            $table->unsignedDecimal('fixed_storage_fee', 5, 2);
            $table->unsignedDecimal('total', 16, 2);

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('car_type_id')->references('id')->on('car_types');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('auction_sales');
    }
};
