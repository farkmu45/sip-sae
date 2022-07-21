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
        Schema::create('nutrition_measurements', function (Blueprint $table) {
            $table->id();
            $table->integer('student_nis');
            $table->unsignedDouble('weight');
            $table->unsignedDouble('height');
            $table->unsignedDouble('height_in_meters')->virtualAs('height / 100');
            $table->unsignedDouble('imt');
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
        Schema::dropIfExists('nutrition_measurements');
    }
};
