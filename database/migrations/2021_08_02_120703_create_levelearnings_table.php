<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelearningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levelearnings', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->integer('l1')->nullable();
            $table->integer('l2')->nullable();
            $table->integer('l3')->nullable();
            $table->integer('l4')->nullable();
            $table->integer('l5')->nullable();
            $table->integer('l6')->nullable();
            $table->integer('l7')->nullable();
            $table->integer('l8')->nullable();
            $table->integer('l9')->nullable();
            $table->integer('l10')->nullable();

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
        Schema::dropIfExists('levelearnings');
    }
}
