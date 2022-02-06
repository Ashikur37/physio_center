<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentTherapyIndividualMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_therapy_individual_machines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_therapy_individual_id');
            $table->unsignedBigInteger('machine_id');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('appointment_therapy_individual_machines');
    }
}
