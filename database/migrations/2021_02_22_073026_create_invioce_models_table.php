<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvioceModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invioce_models', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->string('package_title');
            $table->string('package_speed');
            $table->string('package_price');
            $table->string('cust_id');
            $table->Integer('status')->default(1); //1->Active, 0->inactive
            $table->integer('created_by');
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
        Schema::dropIfExists('invioce_models');
    }
}
