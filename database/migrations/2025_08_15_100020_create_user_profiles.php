<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('user_profiles', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
      $table->foreignId('area_id')->nullable()->constrained('areas')->nullOnDelete();
      $table->foreignId('position_id')->nullable()->constrained('positions')->nullOnDelete();
      $table->boolean('require_2fa')->default(false);
      $table->string('basc_clearance', 20)->default('NONE'); // NONE, L1, L2, L3
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('user_profiles');
  }
};
