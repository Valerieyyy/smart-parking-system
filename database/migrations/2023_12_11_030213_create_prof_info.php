<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prof_info', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('contact_num',20)->nullable()->default(NULL);
            $table->date('birthday')->nullable()->default(NULL);
            $table->string('sex',10)->nullable()->default(NULL);
            $table->text('prof_pic')->nullable()->default(NULL);
            $table->string('address', 100)->nullable()->default(NULL);
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
        Schema::dropIfExists('prof_info');
    }
}
