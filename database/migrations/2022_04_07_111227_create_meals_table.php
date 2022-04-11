<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->string('title', 45);
            $table->string('description', 100);
            $table->string('image');
            $table->float('price');
            $table->enum('status', ['Visible', 'InVisible'])->default('Visible');
            $table->timestamps();
            $table->foreignId('sub_category_id')->constrained()->restrictOnDelete();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meals');
    }
};