<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('material_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_id')->constrained()->onDelete('cascade');
            $table->string('file_path');
            $table->enum('option', ['embed', 'download']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('material_files');
    }
};