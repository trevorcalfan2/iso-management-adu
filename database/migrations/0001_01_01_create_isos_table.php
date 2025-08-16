<?php
// database/migrations/xxxx_xx_xx_create_isos_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIsosTable extends Migration
{
    public function up()
    {
        Schema::create('isos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();  
            $table->string('file_path');
            $table->foreignId('process_id')->constrained('processes')->onDelete('cascade');
            $table->date('expiration_date');
            $table->enum('status', ['active', 'inactive', 'archived'])->default('active');
            $table->string('version');
            $table->timestamps();
        });

        // Relación muchos a muchos con usuarios
        Schema::create('user_iso', function (Blueprint $table) {
            $table->id();
            $table->foreignId('iso_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Relación muchos a muchos con tareas
        Schema::create('task_iso', function (Blueprint $table) {
            $table->id();
            $table->foreignId('iso_id')->constrained()->onDelete('cascade');
            $table->foreignId('task_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Relación muchos a muchos con procesos
        Schema::create('process_iso', function (Blueprint $table) {
            $table->id();
            $table->foreignId('iso_id')->constrained()->onDelete('cascade');
            $table->foreignId('process_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('process_iso');
        Schema::dropIfExists('task_iso');
        Schema::dropIfExists('user_iso');
        Schema::dropIfExists('isos');
    }
}
