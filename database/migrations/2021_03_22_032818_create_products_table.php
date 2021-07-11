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
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->bigInteger('collection_id')->unsigned()->nullable();
            $table->foreign('collection_id')->references('id')->on('collections');
            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->bigInteger('color_id')->unsigned()->nullable();
            $table->foreign('color_id')->references('id')->on('colors');
            $table->bigInteger('discount_id')->unsigned()->nullable();
            $table->foreign('discount_id')->references('id')->on('discounts');
            $table->bigInteger('size_id')->unsigned()->nullable();
            $table->foreign('size_id')->references('id')->on('sizes');
            $table->string('name');
            $table->string('unit_code');
            $table->boolean('status')->default(1);
            $table->double('sale_price', 10, 2)->default(0);
            $table->string('description')->nullable();
            $table->string('image_url', 250)->nullable();
            $table->string('image_second', 250)->nullable();
            $table->string('image_third', 250)->nullable();
            $table->softDeletes();
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
