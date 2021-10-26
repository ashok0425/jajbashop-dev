<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('seller_id')->default(0);
            $table->float('total');
            $table->float('bv');
            $table->float('comission');
            $table->string('order_id');
            $table->string('seller');
            $table->string('payment_mode');
            $table->string('payment_id');
            $table->integer('status')->default(0);
            $table->integer('buyer')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
