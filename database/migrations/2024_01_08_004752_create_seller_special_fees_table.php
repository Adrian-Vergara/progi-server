<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seller_special_fees', function (Blueprint $table) {
            $table->char('id', 36)->primary();

            $table->char('car_type_id', 36);
            $table->unsignedTinyInteger('percentage');

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('car_type_id')->references('id')->on('car_types');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seller_special_fees');
    }
};
