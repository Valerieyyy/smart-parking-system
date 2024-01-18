<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkingManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parking_management', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('parking_code');
            $table->string('time_in');
            $table->string('time_out')->nullable()->default(NULL);;
            $table->string('vehicle_cat_id');
            $table->string('rate_id');
            $table->string('slot_id');
            $table->string('total_time')->nullable()->default(NULL);; 
            $table->string('total_amount')->nullable()->default(NULL);;
            $table->string('paid_status');
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
        Schema::dropIfExists('parking_management');
    }
}
