<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('practice_test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practice_submission_id')->constrained()->onDelete('cascade');
            $table->foreignId('test_case_id')->constrained()->onDelete('cascade');
            $table->boolean('passed')->default(false);
            $table->text('output')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('practice_test_results');
    }
};