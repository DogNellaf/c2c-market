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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
			$table->string('title', 255);
			$table->text('description');
			$table->float('price');
			$table->string('video_link', 255)->nullable();
			$table->string('model_link', 255);
			$table->enum('status', array('Создан', 'Отклонён', 'Скрыт', 'Доступен'))-> default('Создан');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
