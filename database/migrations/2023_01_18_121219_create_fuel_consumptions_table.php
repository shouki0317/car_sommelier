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
        Schema::create('fuel_consumptions', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->integer('distance');
            $table->integer('money');
            $table->float('refueling_amount', 5, 2);
            $table->integer('fuel_price');
            $table->float('fuel_consumption', 5, 1)->nullable();
            $table->integer('account_id');
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
        Schema::dropIfExists('fuel_consumptions');
    }
};
