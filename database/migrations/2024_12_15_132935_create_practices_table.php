<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('practices', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->text('initial_xml')->nullable();
            $table->text('initial_blocks')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('practices');
    }
};