<?php

use App\Models\NutritionalStatus;
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
        Schema::table('nutrition_measurements', function (Blueprint $table) {
            $table->foreign('student_nis')
                ->references('nis')
                ->on('students')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->after('student_nis', function (Blueprint $table) {
                $table->foreignIdFor(NutritionalStatus::class)
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->restrictOnDelete();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nutrition_measurements', function (Blueprint $table) {
            //
        });
    }
};
