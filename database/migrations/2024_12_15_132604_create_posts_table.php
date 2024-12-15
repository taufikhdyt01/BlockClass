<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chapter_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->enum('type', ['material', 'assignment', 'practice', 'discussion_forum']);
            $table->enum('access', ['open', 'hidden', 'sequential'])->default('hidden');
            $table->foreignId('required_post_id')->nullable()->constrained('posts')->nullOnDelete();
            $table->integer('points')->default(0);
            $table->integer('order');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
};