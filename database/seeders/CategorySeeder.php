<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

            [
                "nom"=>"AMPLIFICATEUR",
                "created_at"=>Carbon::now(),
            ],
            [
                "nom"=>"CONVERTISSEUR",
                "created_at"=>Carbon::now(),
            ],
            [
                "nom"=>"HORNS & MEGAPHONES",
                "created_at"=>Carbon::now(),
            ],
            [
                "nom"=>"MICROPHONES",
                "created_at"=>Carbon::now(),
            ],
            [
                "nom"=>"PA SPEAKERS",
                "created_at"=>Carbon::now(),
            ],
            [
                "nom"=>"TABLE DE MIXAGE",
                "created_at"=>Carbon::now(),
            ],


        ];
        Categorie::insert($data);

    }
}
