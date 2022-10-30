<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorBusinessDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_business_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('vendors')->cascadeOnUpdate();
            $table->string('shop_name')->nullable();
            $table->string('shop_address')->nullable();
            $table->string('shop_city')->nullable();
            $table->string('shop_state')->nullable();
            $table->string('shop_country_id')->nullable();
            $table->string('shop_pincode')->nullable();
            $table->string('shop_mobile')->nullable();
            $table->string('shop_website')->nullable();
            $table->string('shop_email')->unique()->nullable();
            $table->string('address_proof')->nullable();
            $table->string('business_license_number')->nullable();
            $table->string('gst_number')->nullable();
            $table->string('pan_number')->nullable();
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
        Schema::dropIfExists('vendor_business_details');
    }
}