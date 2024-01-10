<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('basic_user_fees', function (Blueprint $table) {
            $table->char('id', 36)->primary();

            $table->char('car_type_id', 36);
            $table->unsignedTinyInteger('percentage');
            $table->unsignedDecimal('minimum_value', 8, 2);
            $table->unsignedDecimal('maximum_value', 8, 2);

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('car_type_id')->references('id')->on('car_types');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('basic_user_fees');
    }
};
