<?php

use App\Enums\Gender;
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
        Schema::create('students', function (Blueprint $table) {
            $table->integer('nis')->primary();
            $table->string('name', 45);
            $table->string('address', 45);
            $table->date('date_of_birth');
            $table->enum('gender', [Gender::FEMALE->value, Gender::MALE->value]);
            $table->string('marital_status_of_parents', 45);
            $table->unsignedDouble('school_distance');
            $table->unsignedDouble('salary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
