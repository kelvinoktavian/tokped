<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            // FK
            $table->integer('user_id')->unsigned(); // user has many orders, order belongs to one user
            $table->integer('product_id')->unsigned(); // category has many products, product belongs to one category
            $table->integer('order_status_id')->unsigned(); // category has many products, product belongs to one category
            $table->integer('province_id')->unsigned();
            $table->integer('city_id')->unsigned();

            $table->integer('qty');
            $table->integer('total_price');
            $table->string('street_name');
            $table->string('postal_code');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

            $table->foreign('order_status_id')
                ->references('id')
                ->on('order_statuses')
                ->onDelete('cascade');

            $table->foreign('province_id')
                ->references('id')
                ->on('provinces')
                ->onDelete('cascade');

            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
