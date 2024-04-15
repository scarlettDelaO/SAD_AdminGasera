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
        Schema::create('sales', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned(); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('customer_id')->unsigned(); 
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('detail_id')->unsigned(); 
            $table->foreign('detail_id')->references('id')->on('price_details')->onDelete('cascade')->onUpdate('cascade');
            $table->date('date');
            $table->integer('quantity');
            $table->float('discount');
            $table->bigInteger('pay_id')->unsigned(); 
            $table->foreign('pay_id')->references('id')->on('payment_methods')->onDelete('cascade')->onUpdate('cascade');
            $table->float('total');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
};
