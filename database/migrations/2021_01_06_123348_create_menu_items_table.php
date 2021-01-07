<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->text('photo');
            $table->string('codeno');
            $table->string('name');
            $table->integer('price');
            $table->integer('discount')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('active');
            $table->unsignedBigInteger('menu_category_id');
            $table->unsignedBigInteger('restaurant_id');

            $table->foreign('restaurant_id')->references('id')->on('restaurant_infos')->onDelete('cascade');
            $table->foreign('menu_category_id')->references('id')->on('menu_categories')->onDelete('cascade');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_items');
    }
}
