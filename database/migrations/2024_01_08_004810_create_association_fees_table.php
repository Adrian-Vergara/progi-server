<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('association_fees', function (Blueprint $table) {
            $table->char('id', 36)->primary();

            $table->unsignedDecimal('from', 8, 2);
            $table->unsignedDecimal('to', 8, 2)->nullable();
            $table->unsignedDecimal('amount', 8, 2);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('association_fees');
    }
};
