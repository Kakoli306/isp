<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('zone_id');
            $table->string('customer_name');
            $table->string('mobile_no');
            $table->string('email')->unique();
            $table->string('blood_group');
            $table->string('national_id');
            $table->string('occupation');
            $table->text('address');
            $table->float('month_amount');
            $table->float('bill_amount');
            $table->string('connection_charge');
            $table->string('ip_address');
            $table->date('connection_date');
            $table->string('speed');
            $table->tinyInteger('status');
            $table->tinyInteger('bill_status');

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
        Schema::dropIfExists('customers');
    }
}
