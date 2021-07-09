<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPlateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_plate', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('quantity');
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedBigInteger('plate_id');
            $table->foreign('plate_id')->references('id')->on('plates');
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
        Schema::table('order_plate', function (Blueprint $table) {
            $table->dropForeign('order_plate_order_id_foreign');
            $table->dropForeign('order_plate_plate_id_foreign');
        });

        Schema::dropIfExists('order_plate');
    }
}
