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

        \App\Models\User::factory()->create([
            'name' => 'Faruk',
            'email' => 'fark@admin.com',
            'password' => Hash::make('password'),
        ]);

        $this->call([
            MaleAnthropometrySeeder::class,
            FemaleAnthropometrySeeder::class,
            NutritionalStatusesSeeder::class
        ]);
    }
}
