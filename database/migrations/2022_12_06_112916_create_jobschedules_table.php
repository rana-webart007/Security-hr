<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobschedules', function (Blueprint $table) {
            $table->id();
            $table->Integer('client_id');
            $table->Integer('user_id');
            $table->Integer('security_id');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->Enum('status', ['0', '1', '2']);  //0 -> Inactive, 1-> Active, 2->Bill generate
            $table->Text('comments');
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
        Schema::dropIfExists('jobschedules');
    }
};
