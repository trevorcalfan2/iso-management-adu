<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIso9001DatabaseStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tabla de Usuarios (users)
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();  // Teléfono
            $table->string('cellphone')->nullable();  // Celular
            $table->string('gender')->nullable();  // Género
            $table->text('bio')->nullable();  // Biografía
            $table->string('profile_picture')->nullable();  // Foto de perfil
            $table->boolean('is_admin')->default(false); // Administrador
            $table->boolean('is_active')->default(true); // Usuario activo
            $table->foreignId('area_id')->constrained()->onDelete('cascade'); // Relación con área
            $table->timestamps();
            $table->softDeletes();  // Eliminación suave
        });

        // Tabla de Roles (roles)
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();  // Nombre del rol (Ej. Administrador, Responsable de proceso)
            $table->text('description')->nullable(); // Descripción del rol
            $table->json('permissions')->nullable(); // Lista de permisos asociados al rol
            $table->timestamps();
        });

        // Tabla intermedia User-Roles (role_user)
        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Eliminamos las tablas relacionadas con roles, pero no la tabla 'users'
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');
    }
}
