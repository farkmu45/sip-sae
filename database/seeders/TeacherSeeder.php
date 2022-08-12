<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teacher::create([
            'nip' => 'admin1',
            'address' => fake()->streetAddress(),
            'name' => 'Admin1',
            'password' => Hash::make('sipsae123'),
            'role_id' => 1,
        ]);

        Teacher::create([
            'nip' => 'admin_kelas',
            'address' => fake()->streetAddress(),
            'name' => 'Admin Kelas',
            'password' => Hash::make('sipsae123'),
            'role_id' => 1,
        ]);

        Teacher::create([
            'nip' => 'admin_sekolah',
            'address' => fake()->streetAddress(),
            'name' => 'Admin Sekolah',
            'password' => Hash::make('sipsae123'),
            'role_id' => 1,
        ]);
    }
}
