<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->min(8)->max(255);
            $table->string('email')->min(5)->max(255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
			$table->boolean('is_admin')->default(false);
			$table->boolean('is_banned')->default(false);
            $table->string('avatar_url')->default("images/author.jpg")->max(255);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
