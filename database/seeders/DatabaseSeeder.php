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
        \App\Models\User::factory(10)->create();

        \App\Models\Admin::create([
            'name' => 'Faruk',
            'email' => 'fark@admin.com',
            'password' => Hash::make('password'),
        ]);

        \App\Models\User::create([
            'name' => 'Faruk',
            'nis' => '41201510',
            'password' => Hash::make('password'),
        ]);

        $this->call([
            MaleAnthropometrySeeder::class,
            FemaleAnthropometrySeeder::class,
            NutritionalStatusesSeeder::class
        ]);
    }
}
