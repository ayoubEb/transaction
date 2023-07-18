<?php

namespace Database\Seeders;

use App\Models\CustomizeFacture;
use App\Models\CustomizeStock;
use Illuminate\Database\Seeder;

class CustomizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomizeFacture::create([
            "reference"=>"FAC-0",
            "numero"=>1,
        ]);
        CustomizeStock::create([
            "reference"=>"STO-0",
            "numero"=>1,
        ]);
    }
}
