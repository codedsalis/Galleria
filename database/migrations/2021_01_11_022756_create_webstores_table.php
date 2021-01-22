<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatewebstoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webstores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name', 200);
            $table->string('url', 75);
            $table->text('description');
            $table->string('logo', 50)->nullable();
            $table->string('category', 100);
            $table->text('address')->nullable();
            $table->string('state', 100);
            $table->string('city', 150);
            $table->text('delivery_type'); // nationwide or list of states
            $table->string('service_type'); // Pay on delivery or payment before delivery
            $table->string('email_address', 200)->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->string('whatsapp', 15)->nullable();
            $table->string('facebook', 50)->nullable();
            $table->string('instagram', 50)->nullable();
            $table->string('twitter', 50)->nullable();
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
        Schema::dropIfExists('webstores');
    }
}
