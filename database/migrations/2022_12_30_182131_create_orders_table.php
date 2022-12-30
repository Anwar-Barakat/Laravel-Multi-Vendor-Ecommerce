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
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate();
            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->string('statue');
            $table->foreignId('country_id')->constrained()->cascadeOnUpdate();
            $table->string('email');
            $table->string('mobile');
            $table->string('shipping_charges');
            $table->string('coupon_code');
            $table->float('coupon_amount');
            $table->string('order_status');
            $table->string('paymeny_method');
            $table->string('paymeny_gateway');
            $table->float('grand_total');
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
        Schema::dropIfExists('orders');
    }
}