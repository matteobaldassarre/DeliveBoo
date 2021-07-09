<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_info', function (Blueprint $table) {
            $table->id();
            $table->string('restaurant_name', 255);
            $table->string('address', 255);
            $table->string('VAT', 11);
            $table->string('cover', 255)->nullable();
            $table->string('slug', 255)->unique();
            $table->unsignedBigInteger('restaurant_id');
            $table->timestamps();
            $table->foreign('restaurant_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant_info');
    }
}
