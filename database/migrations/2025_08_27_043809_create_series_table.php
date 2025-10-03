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
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('image_url')->nullable();
            $table->year('start_year');
            $table->year('end_year')->nullable();
            $table->enum('status', ['ongoing', 'completed', 'cancelled','hiatus'])->default('ongoing');
            $table->string('publisher')->default('Marvel Comics');
            $table->enum('genre', ['superhero', 'action', 'adventure', 'sci-fi', 'fantasy', 'horror', 'comedy'])->default('superhero');
            $table->integer('total_issues')->default(0);
            $table->string('frequency')->default('monthly');
            $table->decimal('average_rating',3,2)->default(0);
            $table->integer('popularity_score')->default(0);
            $table->timestamps();

            $table->index('status');
            $table->index('genre');
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
