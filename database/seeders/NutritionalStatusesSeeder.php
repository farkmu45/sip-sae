<?php

namespace Database\Seeders;

use App\Models\NutritionalStatus;
use Illuminate\Database\Seeder;

class NutritionalStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NutritionalStatus::insert([
            ['category' => 'Gizi buruk'],
            ['category' => 'Gizi kurang'],
            ['category' => 'Gizi baik'],
            ['category' => 'Beresiko gizi lebih'],
            ['category' => 'Gizi lebih'],
        ]);
    }
}
