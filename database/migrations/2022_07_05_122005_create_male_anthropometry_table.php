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
        Schema::create('male_anthropometry', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->integer('month');
            $table->double('-3sd');
            $table->double('-2sd');
            $table->double('-1sd');
            $table->double('median');
            $table->double('+1sd');
            $table->double('+2sd');
            $table->double('+3sd');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('male_anthropometry');
    }
};
