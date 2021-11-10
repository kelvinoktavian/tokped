<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('category_id')->unsigned(); // category has many products, product belongs to one category

            $table->string('slug')->unique();
            $table->string('name')->unique();
            $table->integer('price');
            $table->integer('weight')->nullable();
            $table->longText('description')->nullable();
            $table->integer('qty');
            $table->integer('sold')->default(0);
            $table->string('image_path')->default('default.png');
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
