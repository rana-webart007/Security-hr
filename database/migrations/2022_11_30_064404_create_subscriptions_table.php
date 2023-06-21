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
        Schema::create('subscriptions_plans', function (Blueprint $table) {
            $table->id();
            $table->String('name');
            $table->Text('details');
            $table->Double('amount');
            $table->string('max_guards')->nullable();
            $table->Integer('valid_for');

            $table->string('valid_type')->nullable();
            $table->string('extra_charge')->nullable();
            $table->string('total_amount')->nullable();

            $table->string('stripe_product_id')->nullable();
            $table->string('stripe_price_id')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('subscriptions_plans');
    }
};
