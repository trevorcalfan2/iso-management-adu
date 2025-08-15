<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    if (!Schema::hasTable('iso_roles')) {
      Schema::create('iso_roles', function (Blueprint $table) {
        $table->id();
        $table->string('code', 50)->unique(); // SYSTEM_ADMIN, QMR, PROCESS_OWNER, etc.
        $table->string('label', 100);
        $table->timestamps();
      });
    }

    if (!Schema::hasTable('user_iso_roles')) {
      Schema::create('user_iso_roles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->foreignId('iso_role_id')->constrained('iso_roles')->cascadeOnDelete();
        $table->unique(['user_id','iso_role_id']);
        $table->timestamps();
      });
    }
  }

  public function down(): void {
    Schema::dropIfExists('user_iso_roles');
    Schema::dropIfExists('iso_roles');
  }
};
