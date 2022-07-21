<?php

namespace Database\Seeders;

use JeroenZwart\CsvSeeder\CsvSeeder;

class FemaleAnthropometrySeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->tablename = 'female_anthropometry';
        $this->file = base_path().'/database/seeders/csv/female_anthropometry.csv';
        $this->delimiter = ',';
        $this->timestamps = false;
    }

    public function run()
    {
        parent::run();
    }
}
