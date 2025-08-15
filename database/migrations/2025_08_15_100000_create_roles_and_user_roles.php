<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('roles', function (Blueprint $table) {
      $table->id();
      $table->string('code', 50)->unique(); // SYSTEM_ADMIN, QMR, PROCESS_OWNER, AREA_ASSISTANT, AUDITOR, BASC_OFFICER, READER
      $table->string('label', 100);
      $table->timestamps();
    });

    Schema::create('user_roles', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->cascadeOnDelete();
      $table->foreignId('role_id')->constrained('roles')->cascadeOnDelete();
      $table->unique(['user_id','role_id']);
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('user_roles');
    Schema::dropIfExists('roles');
  }
};
