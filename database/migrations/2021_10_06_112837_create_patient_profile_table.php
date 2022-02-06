<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_profile', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id');
            $table->bigInteger('phone');
            $table->integer('age');
            $table->string('address');
            $table->string('nid');
            $table->string('gender')->comment('1=male, 2=female');
            $table->string('blood')->comment('1=A+ | 2=A- | 3=B+ | 4=B- | 5=AB+ | 6=AB- | 7=O+ | 8=O-');
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
        Schema::dropIfExists('patient_profile');
    }
}
