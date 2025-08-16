<?php
// database/migrations/xxxx_xx_xx_create_processes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessesTable extends Migration
{
    public function up()
    {
        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');  // Relación con el usuario propietario
            $table->date('expiration_date')->nullable();  // Fecha de vencimiento o revisión
            $table->timestamps();
        });

        // Tabla intermedia para la relación muchos a muchos con roles
        Schema::create('process_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('process_id')->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Tabla intermedia para la relación muchos a muchos con usuarios
        Schema::create('process_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('process_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Tabla intermedia para la relación muchos a muchos con archivos ISO
        Schema::create('process_iso', function (Blueprint $table) {
            $table->id();
            $table->foreignId('process_id')->constrained()->onDelete('cascade');
            $table->foreignId('iso_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('process_iso');
        Schema::dropIfExists('process_user');
        Schema::dropIfExists('process_role');
        Schema::dropIfExists('processes');
    }
}
