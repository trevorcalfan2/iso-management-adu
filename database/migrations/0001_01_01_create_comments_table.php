<?php
// database/migrations/xxxx_xx_xx_create_comments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Relación con el usuario que hizo el comentario
            $table->foreignId('iso_id')->nullable()->constrained()->onDelete('cascade');  // Relación con archivo ISO
            $table->foreignId('process_id')->nullable()->constrained()->onDelete('cascade');  // Relación con proceso
            $table->foreignId('task_id')->nullable()->constrained()->onDelete('cascade');  // Relación con tarea
            $table->text('comment');  // Contenido del comentario
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
