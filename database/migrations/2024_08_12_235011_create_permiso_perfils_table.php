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

        Schema::create('permiso_perfils', function (Blueprint $table) {
            $table->unsignedBigInteger('id_permiso_perfil')->autoIncrement()->primary();
            $table->foreignId('id_perfil')->constrained('perfil', 'id_perfil')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_permiso')->constrained('permisos', 'id_permiso')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('permiso_perfils');
    }
};
