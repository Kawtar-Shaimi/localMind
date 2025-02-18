<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->string('location_name');
            $table->integer('views_count')->default(0);
            $table->integer('answers_count')->default(0);
            $table->integer('favorites_count')->default(0);
            $table->timestamps();
            $table->index(['latitude', 'longitude']);
        });
    }

    public function down() {
        Schema::dropIfExists('questions');
    }
};
