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
        Schema::create('guards_job_locations', function (Blueprint $table) {
            $table->id();
            $table->string('job_id');
            $table->string('user_id');
            $table->string('job_address_id', 50)->nullable();
            $table->string('job_locations', 1000);
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
        Schema::dropIfExists('guards_job_locations');
    }
};
