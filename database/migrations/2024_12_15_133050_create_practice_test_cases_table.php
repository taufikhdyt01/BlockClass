<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('practice_test_cases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practice_id')->constrained()->onDelete('cascade');
            $table->text('input');
            $table->text('expected_output');
            $table->boolean('is_sample')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('practice_test_cases');
    }
};