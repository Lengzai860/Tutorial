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
            $table->integer('user_id')->unique();
            $table->double('total_amount');
            $table->integer('delivery_company_id');
            $table->string('delivery_company_name');
            $table->string('tracking_code');
            $table->integer('delivery_status');
            $table->double('payment_status');
            $table->double('discount_amount');
            $table->double('total_payment_amount');
            $table->integer('points');
            $table->string('payment_method');
            $table->string('receiver_name');
            $table->string('receiver_contact');
            $table->string('receiver_email');
            $table->string('address1');
            $table->string('address2');
            $table->integer('city_id');
            $table->integer('state_id');
            $table->integer('country_id');
            $table->integer('postcode');
            $table->string('transcation_id');
            $table->integer('status');
            $table->dateTime('deleted_at');
            $table->dateTime('updated_at');
            $table->dateTime('created_at');
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
