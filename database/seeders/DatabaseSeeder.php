<?php

namespace Database\Seeders;

use App\Enums\Role;
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
        \App\Models\Job::factory(10)->create();

        \App\Models\Role::create([
            'name' => Role::ADMIN->value,
        ]);

        \App\Models\Role::create([
            'name' => Role::TEACHER->value,
        ]);


        // \App\Models\Student::create([
        //     'nis' => 41201510,
        //     'name' => 'Faruk Maulana',
        //     'address' => fake()->streetAddress(),
        //     'date_of_birth' => '2010-07-08',
        //     'marital_status_of_parents' => fake()->words(2, true),
        //     'school_distance' => 27,
        //     'salary' => 1500,
        //     'job_id' => 1,
        //     'classroom_id' => 1,
        //     'gender' => 'MALE',
        // ]);

        \App\Models\Teacher::create([
            'nip' => '41201510',
            'address' => fake()->streetAddress(),
            'name' => 'Faruk',
            'password' => Hash::make('password'),
            'role_id' => 1,
        ]);

        // \App\Models\User::create([
        //     'student_nis' => '41201510',
        //     'password' => Hash::make('password'),
        // ]);

        $this->call([
            TeacherSeeder::class,
            MaleAnthropometrySeeder::class,
            FemaleAnthropometrySeeder::class,
            NutritionalStatusesSeeder::class,
        ]);
    }
}
