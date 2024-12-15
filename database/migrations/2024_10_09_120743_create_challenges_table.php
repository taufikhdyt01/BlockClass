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
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->enum('difficulty', ['easy', 'medium', 'hard']);
            $table->string('category');
            $table->enum('access_type', ['public', 'private', 'sequential'])->default('public');
            $table->string('access_code')->nullable();
            $table->foreignId('required_challenge_id')->nullable()->references('id')->on('challenges')->onDelete('set null');
            $table->string('function_name');
            $table->text('initial_xml');
            $table->json('hints')->nullable();
            $table->json('constraints');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenges');
    }
};
