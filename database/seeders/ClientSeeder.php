<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
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
                    "group_id"=>1,
                    "raison_sociale"=>"Ronan Prevost",
                    "responsable"=>"Ambroise Morin",
                    "adresse"=>"480 Passage Du Sommerard",
                    "email"=>"alix_aubert@gmail.com",
                    "ville"=>"Limoges",
                    "ice"=>"041689336",
                    "if"=>"575287430",
                    "rc"=>"041689336",
                    "telephone"=> '6454544833',
                    "code_postal"=>12600,
                    "activite"=>"act",
                    "type_client_id"=>1,
                    ],
                    [
                    "group_id"=>1,
                    "raison_sociale"=>"Béranger Bonnet",
                    "responsable"=>"Ambroise Morin",
                    "adresse"=>"10 Voie Vaneau - Pau",
                    "email"=>"melchiormoulin.pierre@yahoo.fr",
                    "ville"=>"Yémen",
                    "ice"=>"855123",
                    "if"=>"2306855123452",
                    "rc"=>"116123",
                    "telephone"=> '625121415',
                    "code_postal"=>92057,
                    "activite"=>"act",
                    "type_client_id"=>1,
                    ],
                    [
                    "group_id"=>2,
                    "raison_sociale"=>"Béranger Bonnet",
                    "responsable"=>"Ambroise Morin",
                    "adresse"=>"10 Voie Vaneau - Pau",
                    "email"=>"melchiormoulin.pierre@yahoo.fr",
                    "ville"=>"Yémen",
                    "ice"=>"855123",
                    "if"=>"2306751123456",
                    "rc"=>"116123",
                    "telephone"=> '625121415',
                    "code_postal"=>33956,
                    "activite"=>"act",
                    "type_client_id"=>2,
                    ],
                ];
        Client::insert($data);
    }
}
