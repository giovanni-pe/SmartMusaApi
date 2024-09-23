<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSensorActuatorActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensor_actuator_actions', function (Blueprint $table) {
            $table->id();  
            $table->enum('action', ['activate', 'deactivate']);  
            $table->dateTime('start_time');  
            $table->dateTime('end_time')->nullable();  
            $table->timestamps();  
            $table->foreignId('sensor_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('actuator_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensor_actuator_actions');
    }
}
