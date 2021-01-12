<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('codeno');
            $table->string('orderdate');
            $table->string('total');
            $table->string('status')->default('order');
            $table->unsignedBigInteger('waiter_id');
            $table->unsignedBigInteger('table_id');
            $table->timestamps();
            
            $table->foreign('waiter_id')->references('id')->on('staff')->onDelete('cascade');
            $table->foreign('table_id')->references('id')->on('table_infos')->onDelete('cascade');

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
        Schema::dropIfExists('orders');
    }
}
