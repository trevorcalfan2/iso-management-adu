<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    if (!Schema::hasTable('user_process_roles')) {
      Schema::create('user_process_roles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->foreignId('process_id')->constrained('processes')->cascadeOnDelete();
        $table->foreignId('iso_role_id')->constrained('iso_roles')->cascadeOnDelete(); // p.ej. PROCESS_OWNER
        $table->unique(['user_id','process_id','iso_role_id']);
        $table->timestamps();
      });
    }
  }
  public function down(): void {
    Schema::dropIfExists('user_process_roles');
  }
};
