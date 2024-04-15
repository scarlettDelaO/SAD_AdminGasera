<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsPriceTable extends Migration
{
    public function up()
    {
        Schema::create('pricedetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // Campo compartido
            $table->unsignedBigInteger('price_id'); // Campo compartido
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pricedetails');
    }
}
