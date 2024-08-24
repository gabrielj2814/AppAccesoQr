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
            $table->id();
            $table->string('url_qr', 255);
            $table->string('token_qr', 255);
            $table->boolean('se_puede_vencer')->default(1);
            $table->date('fecha_vencimiento')->nullable();
            $table->boolean('status')->default(1);
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
