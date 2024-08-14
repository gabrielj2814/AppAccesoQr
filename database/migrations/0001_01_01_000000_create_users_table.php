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


        Schema::create('perfil', function (Blueprint $table) {
            $table->id("id_perfil");
            $table->string('nombre');
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('persona', function (Blueprint $table) {
            $table->id("id_persona");
            $table->string('nombre');
            $table->string('apellido');
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tipo_usuario', function (Blueprint $table) {
            $table->id("id_tipo_usuario");
            $table->string('nombre');
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('pin',4)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('status');
            $table->unsignedBigInteger('id_perfil')->nullable();
            $table->foreign("id_perfil")->references("id_perfil")->on("perfil")->onUpdate("cascade")->onDelete("cascade");
            $table->unsignedBigInteger('id_persona');
            $table->foreign("id_persona")->references("id_persona")->on("persona")->onUpdate("cascade")->onDelete("cascade");
            $table->unsignedBigInteger('id_tipo_usuario')->nullable();
            $table->foreign("id_tipo_usuario")->references("id_tipo_usuario")->on("tipo_usuario")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('persona');
        Schema::dropIfExists('tipo_usuario');
        Schema::dropIfExists('perfil');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
