<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('assignment_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_id')->constrained()->onDelete('cascade');
            $table->string('file_path');
            $table->enum('option', ['embed', 'download']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('assignment_files');
    }
};