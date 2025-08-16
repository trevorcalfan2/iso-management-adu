<?php
// database/migrations/xxxx_xx_xx_create_users_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();  
            $table->string('cellphone')->nullable();  
            $table->enum('gender', ['male', 'female', 'other'])->nullable();  
            $table->text('bio')->nullable();  
            $table->string('profile_picture')->nullable();  
            $table->boolean('is_admin')->default(false); 
            $table->boolean('is_active')->default(true); 
            $table->foreignId('area_id')->constrained()->onDelete('cascade'); 
            $table->timestamps();
            $table->softDeletes();  
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}

