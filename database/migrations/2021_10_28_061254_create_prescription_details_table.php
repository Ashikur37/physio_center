<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_details', function (Blueprint $table) {
            $table->id();
            $table->integer('doctor_id')->default(0);
            $table->integer('patient_id')->default(0);
            $table->integer('appointment_id')->default(0);
            $table->string('details')->nullable();
            $table->string('medicine_name')->nullable();
            $table->string('meal')->nullable();
            $table->string('medicine_liquid')->nullable();
            $table->string('medicine_solid')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('prescription_details');
    }
}
