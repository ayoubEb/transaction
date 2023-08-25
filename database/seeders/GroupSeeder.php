<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
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
                "nom"=>"Administration",
                "remise"=>10,
                "statut"=>"activer",
            ],
            [
                "nom"=>"commerce en gros",
                "remise"=>0,
                "statut"=>"activer",
            ],
            [
                "nom"=>"Particulier",
                "remise"=>0,
                "statut"=>"activer",
            ],
            [
                "nom"=>"publique",
                "remise"=>0,
                "statut"=>"activer",
            ],
            [
                "nom"=>"Revendeur",
                "remise"=>0,
                "statut"=>"activer",
            ],
            [
                "nom"=>"Société",
                "remise"=>0,
                "statut"=>"activer",
            ],
        ];
        Group::insert($data);
    }
}
