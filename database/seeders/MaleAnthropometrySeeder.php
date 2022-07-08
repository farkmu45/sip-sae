<?php

namespace Database\Seeders;

use JeroenZwart\CsvSeeder\CsvSeeder;

class MaleAnthropometrySeeder extends CsvSeeder
{

    public function __construct()
    {
        $this->tablename = 'male_anthropometry';
        $this->file = base_path().'/database/seeders/csv/male_anthropometry.csv';
        $this->delimiter = ',';
        $this->timestamps = false;
    }

    public function run()
    {
        parent::run();
    }
}
