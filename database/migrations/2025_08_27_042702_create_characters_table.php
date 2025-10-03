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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('real_name')->nullable();
            $table->string('alias')->nullable();
            $table->string('image_url')->nullable();
            $table->string('thumbnail_url')->nullable();
            $table->json('powers')->nullable();
            $table->string('first_appearance')->nullable();
            $table->enum('type',['hero', 'villain', 'antihero','neutral'])->default('hero');
            $table->string('origin')->nullable();
            $table->json('teams')->nullable();
            $table->integer('strength')->nullable();
            $table->integer('intelligence')->nullable();
            $table->integer('speed')->nullable();
            $table->integer('durability')->nullable();
            $table->integer('energy_projection')->nullable();
            $table->integer('fighting_skills')->nullable();
            $table->enum('status',['active','inactive','deceased'])->default('active');
            $table->timestamps();

            //indexes for better performance
            $table->index('slug');
            $table->index('type');
            $table->index('status');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
