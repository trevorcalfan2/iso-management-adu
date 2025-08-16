<?php
// database/migrations/xxxx_xx_xx_create_isoversion_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateISOVersionTable extends Migration
{
    public function up()
    {
        Schema::create('iso_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('iso_id')->constrained()->onDelete('cascade');  // Relación con archivo ISO
            $table->string('version_number');  // Número de versión
            $table->date('release_date');  // Fecha de lanzamiento de la versión
            $table->string('file_path');  // Ruta al archivo ISO de esta versión
            $table->text('changes')->nullable();  // Descripción de los cambios realizados
            $table->enum('status', ['active', 'inactive'])->default('active');  // Estado de la versión
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('iso_versions');
    }
}
