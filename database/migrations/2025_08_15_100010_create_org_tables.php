<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('areas', function (Blueprint $table) {
      $table->id();
      $table->string('name', 120)->unique();
      $table->timestamps();
    });

    Schema::create('positions', function (Blueprint $table) {
      $table->id();
      $table->string('name', 120)->unique();
      $table->timestamps();
    });

    Schema::create('processes', function (Blueprint $table) {
      $table->id();
      $table->string('name', 160)->unique();
      $table->foreignId('parent_id')->nullable()->constrained('processes')->nullOnDelete();
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('processes');
    Schema::dropIfExists('positions');
    Schema::dropIfExists('areas');
  }
};
