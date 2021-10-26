<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->integer('category_id');
            $table->integer('subcategory_id')->nullable();
            $table->float('price');
            $table->integer('bv');
            $table->integer('sc');
            $table->integer('dc');
            $table->integer('gst');
            $table->integer('featured')->nullable();
            $table->integer('top_rated')->nullable();
            $table->integer('bestseller')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_descr')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->text('descr')->nullable();
            $table->text('short_desc')->nullable();
            $table->text('front')->nullable();
            $table->text('back')->nullable();
            $table->text('left')->nullable();
            $table->text('right')->nullable();
            $table->text('term')->nullable();
            $table->text('material')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('products');
    }
}
