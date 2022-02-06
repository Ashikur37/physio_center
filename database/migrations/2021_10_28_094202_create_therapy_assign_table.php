<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTherapyAssignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('therapy_assign', function (Blueprint $table) {
            $table->id();
            $table->integer('appointment_id')->default(0);
            $table->integer('doctor_assign_id')->default(0);
            $table->integer('patient_id')->default(0);
            $table->integer('therapy_id')->default(0);
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
        Schema::dropIfExists('therapy_assign');
    }
}
