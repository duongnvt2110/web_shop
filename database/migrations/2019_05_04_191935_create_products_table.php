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
            $table->integer('admin_id');
            $table->integer('category_id')->unsigned()->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('product_name')->unique()->nullable();
            $table->string('thumnail')->nullable();
            $table->text('image')->nullable();
            $table->text('short_description')->nullable();
            $table->text('full_description')->nullable();
            $table->boolean('published')->default(false);
            $table->integer('price')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('fee_ship')->nullable();
            $table->timestamps();

            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
            ->onDelete('set null');

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
