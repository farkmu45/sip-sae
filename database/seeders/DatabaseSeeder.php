<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Classroom::factory(10)->create();
        \App\Models\Job::factory(10)->create();
        \App\Models\Teacher::factory(10)->create();
        \App\Models\Narration::factory(10)->create();
        \App\Models\Student::factory(10)->create();

        \App\Models\Student::create([
            'nis' => 41201510,
            'name' => 'Faruk Maulana',
            'address' => fake()->streetAddress(),
            'date_of_birth' => fake()->date(),
            'marital_status_of_parents' => fake()->words(2, true),
            'school_distance' => 27,
            'salary' => 1500,
            'job_id' => 1,
            'classroom_id' => 1,
            'gender' => 'MALE'
        ]);

        \App\Models\Admin::create([
            'name' => 'Faruk',
            'email' => 'fark@admin.com',
            'password' => Hash::make('password'),
        ]);

        \App\Models\User::create([
            'student_nis' => '41201510',
            'password' => Hash::make('password'),
        ]);

        $this->call([
            MaleAnthropometrySeeder::class,
            FemaleAnthropometrySeeder::class,
            NutritionalStatusesSeeder::class
        ]);
    }
}
