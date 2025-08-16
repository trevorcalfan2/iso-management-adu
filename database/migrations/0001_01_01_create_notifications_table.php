<?php
// database/migrations/xxxx_xx_xx_create_notifications_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Relación con el usuario que recibe la notificación
            $table->text('message');  // Mensaje de la notificación
            $table->string('type');  // Tipo de notificación (ISO, proceso, tarea, etc.)
            $table->enum('status', ['pending', 'read'])->default('pending');  // Estado de la notificación
            $table->morphs('related');  // Relación polimórfica con el modelo relacionado (ISO, tarea, proceso)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
