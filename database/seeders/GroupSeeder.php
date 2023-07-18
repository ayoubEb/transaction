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
                "nom"=>"société",
                "remise"=>0,
                "statut"=>"activer",
            ],
            [
                "nom"=>"particulier",
                "remise"=>0,
                "statut"=>"activer",
            ],
            [
                "nom"=>"groupement",
                "remise"=>0,
                "statut"=>"activer",
            ],
            [
                "nom"=>"administration",
                "remise"=>0,
                "statut"=>"activer",
            ],
            [
                "nom"=>"publique",
                "remise"=>0,
                "statut"=>"activer",
            ],
            [
                "nom"=>"commerce en gros",
                "remise"=>0,
                "statut"=>"activer",
            ],
        ];
        Group::insert($data);
    }
}
