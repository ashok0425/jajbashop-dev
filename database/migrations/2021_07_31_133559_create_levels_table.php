<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('l1')->nullable();
            $table->string('l2')->nullable();
            $table->string('l3')->nullable();
            $table->string('l4')->nullable();
            $table->string('l5')->nullable();
            $table->string('l6')->nullable();
            $table->string('l7')->nullable();
            $table->string('l8')->nullable();
            $table->string('l9')->nullable();
            $table->string('l10')->nullable();
            $table->string('l11')->nullable();
            $table->string('l12')->nullable();
            $table->string('l13')->nullable();
            $table->string('l14')->nullable();
            $table->string('l15')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('levels')->nullable();
    }
}
