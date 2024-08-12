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

        Schema::create('qr_usuarios', function (Blueprint $table) {
            $table->unsignedBigInteger('id_qr_usuario')->autoIncrement()->primary();
            $table->string('url_qr', 255);
            $table->string('token_qr', 255);
            $table->boolean('se_puede_vencer');
            $table->date('fecha_vencimiento')->nullable();
            $table->boolean('status');
            $table->foreignId('id_user')->nullable()->constrained('users')->cascadeOnDelete()->cascadeOnUpdate()->index();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('qr_usuarios');
    }
};