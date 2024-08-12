<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('puertas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_puerta')->autoIncrement()->primary();
            $table->string('nombre', 255);
            $table->string('codigo', 255);
            $table->foreignId('id_zona')->constrained('zonas', 'id_zona')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puertas');
    }
};
