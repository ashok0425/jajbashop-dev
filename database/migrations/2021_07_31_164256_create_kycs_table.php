<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKycsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kycs', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('Bank_name')->nullable();
            $table->string('account_no')->nullable();
            $table->string('adhar_card_no')->nullable();
            $table->string('ifsc')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('google_pay_id')->nullable();
            $table->string('phone_pay_id')->nullable();
            $table->string('adhar_back')->nullable();
            $table->string('adhar_front')->nullable();
            $table->string('bankproof')->nullable();
            $table->string('pancopy')->nullable();

            $table->integer('status')->default(0);





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
        Schema::dropIfExists('kycs')->nullable();
    }
}
