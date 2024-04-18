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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('detail_id')->unsigned(); 
            $table->foreign('detail_id')->references('id')->on('price_details')->onDelete('cascade')->onUpdate('cascade');
            $table->float('previusPrice');
            $table->date('changeDate');
            $table->string('reason');
            $table->float('actualPrice');


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
        Schema::dropIfExists('prices');
    }
};
