<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('patient_id');
            $table->integer('amount')->default(0);
            $table->integer('discount_get')->default(0);
            $table->integer('sub_total')->default(0);
            $table->integer('advanced_pay')->default(0);
            $table->integer('due_have')->default(0);
            $table->tinyInteger('type')->comment('0=undefine | 1=complete | 2=advanced | 3=due | 4=pay');
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
        Schema::dropIfExists('payment');
    }
}
