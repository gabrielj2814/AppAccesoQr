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

        Schema::create('log_accesos', function (Blueprint $table) {
            $table->id();
            $table->string('mensaje', 255);
            $table->date('fecha');
            $table->time('hora');
            $table->string('lado', 10);
            $table->foreignId('qr_usuario_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('puerta_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_accesos');
    }
};
