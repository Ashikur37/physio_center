<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppoinmentPaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appoinment_payment_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appoinment_payment_id')->nullable();
            $table->unsignedBigInteger('user_id');

            $table->unsignedBigInteger('mobile_agent_id')->nullable();
            $table->integer('amount');
            $table->integer('is_cash');
            $table->string('sender_type')->nullable();
            $table->string('sender_number')->nullable();
            $table->string('trans_id')->nullable();
            $table->text('note');
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
        Schema::dropIfExists('appoinment_payment_histories');
    }
}
