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
            'password' => '$2y$10$hiknmmzerBhpwyTywqvrsu4j.xCUbKM.n3TT8DxJORxtxVw71KdOW',
            'role_id' => 1,
        ]);

        Teacher::create([
            'nip' => 'admin_kelas',
            'address' => fake()->streetAddress(),
            'name' => 'Admin Kelas',
            'password' => '$2y$10$hiknmmzerBhpwyTywqvrsu4j.xCUbKM.n3TT8DxJORxtxVw71KdOW',
            'role_id' => 1,
        ]);

        Teacher::create([
            'nip' => 'admin_sekolah',
            'address' => fake()->streetAddress(),
            'name' => 'Admin Sekolah',
            'password' => '$2y$10$hiknmmzerBhpwyTywqvrsu4j.xCUbKM.n3TT8DxJORxtxVw71KdOW',
            'role_id' => 1,
        ]);
    }
}
