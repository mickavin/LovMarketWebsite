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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->string('image');
            $table->decimal('price');
            $table->decimal('new_price')->nullable();
            $table->integer('units');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('product_categories');
            $table->unsignedBigInteger('shopId');
            $table->foreign('shopId')->references('id')->on('shops')->onDelete('cascade');
            $table->boolean('activated');
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
