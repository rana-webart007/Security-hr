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
        Schema::create('job_repeat_history', function (Blueprint $table) {
            $table->id();
            $table->string('security_id');
            $table->string('job_id');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('repeat_for');
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
        Schema::dropIfExists('job_repeat_history');
    }
};
