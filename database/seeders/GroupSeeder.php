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
                "remise"=>15,
                "statut"=>"activer",
            ],
            [
                "nom"=>"particulier",
                "remise"=>30,
                "statut"=>"activer",
            ],
            [
                "nom"=>"groupement",
                "remise"=>40,
                "statut"=>"activer",
            ],
            [
                "nom"=>"administration",
                "remise"=>10,
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
