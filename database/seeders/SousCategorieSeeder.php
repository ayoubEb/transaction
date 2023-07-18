<?php

namespace Database\Seeders;

use App\Models\SousCategorie;
use Illuminate\Database\Seeder;

class SousCategorieSeeder extends Seeder
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
                "categorie_id"=>11,
                "nom"=>"Ordinateur",
            ],
            [
                "categorie_id"=>11,
                "nom"=>"écran pc",
            ],
            [
                "categorie_id"=>11,
                "nom"=>"Réseau pc",
            ],
            [
                "categorie_id"=>11,
                "nom"=>"Accessoires pc",
            ],
            [
                "categorie_id"=>11,
                "nom"=>"Composants pc",
            ],
            [
                "categorie_id"=>8,
                "nom"=>"Sport & fitness",
            ],
            [
                "categorie_id"=>8,
                "nom"=>"Cyclisme",
            ],
            [
                "categorie_id"=>8,
                "nom"=>"Top marque",
            ],
            [
                "categorie_id"=>8,
                "nom"=>"Natation",
            ],
            [
                "categorie_id"=>8,
                "nom"=>"Vêtements",
            ],
            [
                "categorie_id"=>8,
                "nom"=>"Football",
            ],
            [
                "categorie_id"=>8,
                "nom"=>"Musculation",
            ],
        ];

        SousCategorie::insert($data);
    }
}
