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
        Schema::create('guard_tracking_histories', function (Blueprint $table) {
            $table->id();
            $table->string('guard_id');
            $table->string('security_id');
            $table->string('job_id');
            $table->string('client_id')->nullable();
            $table->string('tracking_id', 100)->nullable();
            $table->string('tracking_date');
            $table->string('tracking_time');
            $table->string('guard_coordinate');
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
        Schema::dropIfExists('guard_tracking_histories');
    }
};
