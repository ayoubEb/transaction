<?php

namespace Database\Seeders;

use App\Models\CustomizeAchat;
use App\Models\CustomizeFacture;
use App\Models\CustomizeFactureRetour;
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
            "reference"=>"FAC-00",
            "numero"=>1,
            "tva"=>20,
        ]);
        CustomizeAchat::create([
            "reference"=>"FAC-00",
            "numero"=>1,
            "tva"=>20,
        ]);
        CustomizeStock::create([
            "reference"=>"STO-00",
            "numero"=>1,
        ]);
        CustomizeFactureRetour::create([
            "reference"=>"FAC-00",
            "numero"=>1,
        ]);
    }
}
