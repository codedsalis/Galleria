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
            $table->increments('id');
            $table->integer('webstore_id')->unsigned();
            $table->foreign('webstore_id')->references('id')->on('webstores')->onDelete('cascade');
            $table->string('name', 250);
            $table->text('description');
            $table->string('product_category', 50);
            $table->integer('price'); // price is in kobo
            $table->integer('discount_price'); // discount_price is in kobo
            $table->string('images');
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
