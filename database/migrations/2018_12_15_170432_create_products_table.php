<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigInteger('category_id');
            $table->string('product_title',255);
            $table->string('product_sku',255);
            $table->longText('product_desc',255)->nullable();
            $table->enum('product_type',['Simple','Virtual']);
            $table->string('product_pic',255)->nullable();
            $table->tinyInteger('status');
            $table->bigInteger('created_by');
            $table->bigInteger('modified_by')->nullable();
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
