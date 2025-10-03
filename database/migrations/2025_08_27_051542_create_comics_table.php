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
        Schema::create('comics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('series_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('cover_image');
            $table->integer('issue_number');
            $table->date('release_date');
            $table->string('writer')->nullable();
            $table->string('artist')->nullable();
            $table->string('colorist')->nullable();
            $table->string('letterer')->nullable();
            $table->string('page_count')->default(20);
            $table->decimal('price', 8, 2)->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('rating_count')->default(0);
            $table->enum('status', ['published', 'upcoming', 'draft'])->default('published');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            $table->index(['series_id', 'issue_number']);
            $table->index('release_date');
            $table->index('status');
            $table->unique(['series_id','issue_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comics');
    }
};
