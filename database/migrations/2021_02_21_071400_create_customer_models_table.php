<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_models', function (Blueprint $table) {
            $table->id();
            $table->Integer('user_id')->nullable();
            $table->Integer('package_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('nid');
            $table->string('pon_mac');
            $table->string('route_mac');
            $table->longText('address');
            $table->dateTime('active_date')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('customer_models');
    }
}
