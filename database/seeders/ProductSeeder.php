<?php

namespace Database\Seeders;

use App\Models\Produit;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class ProductSeeder extends Seeder
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
                "categorie_id"=>2,
                "reference"=>Str::upper("a-001"),
                "designation"=>"crèmes, émulsions, lotions, gels et huiles pour la peau",
                "description"=>"description crèmes, émulsions, lotions, gels et huiles pour la peau",
                "prix_vente"=>260,
                "prix_achat"=>250,
                "prix_unitaire"=>240,
                "quantite"=>15,
                "created_at"=>Carbon::now(),
                "updated_at"=>Carbon::now(),
            ],
            [
                "categorie_id"=>2,
                "reference"=>Str::upper("a-002"),
                "designation"=>"masques de beauté",
                "description"=>"description masques de beauté",
                "prix_vente"=>230 ,
                "prix_achat"=>220,
                "prix_unitaire"=>210,
                "quantite"=>10,
                "created_at"=>Carbon::now(),
                "updated_at"=>Carbon::now(),
            ],
            [
                "categorie_id"=>2,
                "reference"=>Str::upper("a-003"),
                "designation"=>"fonds de teint (liquides, pâtes, poudres)",
                "description"=>"",
                "prix_vente"=>120,
                "prix_achat"=>110,
                "prix_unitaire"=>100,
                "quantite"=>20,
                "created_at"=>Carbon::now(),
                "updated_at"=>Carbon::now(),
            ],
            [
                "categorie_id"=>2,
                "reference"=>Str::upper("a-004"),
                "designation"=>"colorants capillaires",
                "description"=>"description colorants capillaires",
                "prix_vente"=>80,
                "prix_achat"=>70,
                "prix_unitaire"=>60,
                "quantite"=>15,
                "created_at"=>Carbon::now(),
                "updated_at"=>Carbon::now(),
            ],
            [
                "categorie_id"=>2,
                "reference"=>Str::upper("a-005"),
                "designation"=>"dépilatoires",
                "description"=>"description colorants capillaires",
                "prix_vente"=>50,
                "prix_achat"=>40,
                "prix_unitaire"=>30,
                "quantite"=>15,
                "created_at"=>Carbon::now(),
                "updated_at"=>Carbon::now(),
            ],

            [
                "categorie_id"=>3 , "reference"=>Str::upper("b-001"),
                "designation"=>"Laits doux et onctueux et lotions apaisantes" , "description"=>"Les eaux micellaires en s’appliquant avec un coton irritent les peaux fragiles alors qu’un lait bien onctueux et moelleux passé avec les doigts en légers “pianotements” sur le visage, le cou et le décolleté entraînent délicatement toutes les impuretés déposées ainsi que le maquillage et il ne faut pas hésiter à le rincer à l’eau tiède, surtout si la peau est réactive et sensible. On pratique ce que l’on appelle des ablutions, on laisse couler l’eau du robinet et l’on s’en sert en la prenant dans ses mains pour la projeter sur le visage. Cela laisse une sensation intense de propreté. On sèche ensuite en posant simplement une petite serviette sèche sur le visage et le cou sans frotter.",
                "prix_vente"=>340  , "prix_achat"=>330,
                "prix_unitaire"=>320 , "quantite"=>15,
                "created_at"=>Carbon::now() , "updated_at"=>Carbon::now(),
            ],
            [
                "categorie_id"=>3 , "reference"=>Str::upper("b-002"),
                "designation"=>"Clémence" , "description"=>"Ce baume onctueux est nourrissant et réparateur, au parfum fleurs d'été. Il peut être utilisé sur tout le corpe",
                "prix_vente"=>230 , "prix_achat"=>220,
                "prix_unitaire"=>210 , "quantite"=>15,
                "created_at"=>Carbon::now() , "updated_at"=>Carbon::now(),
            ],
            [
                "categorie_id"=>3 , "reference"=>Str::upper("b-003"),
                "designation"=>"Omum Le bienfaiteur" , "description"=>"Ce lait 2-en-1 hydrate, apaise et assouplit la peau très sèche et inconfortable. Idéal pour les futures",
                "prix_vente"=>120 , "prix_achat"=>110,
                "prix_unitaire"=>100 , "quantite"=>15,
                "created_at"=>Carbon::now() , "updated_at"=>Carbon::now(),
            ],
            [
                "categorie_id"=>3 , "reference"=>Str::upper("b-004"),
                "designation"=>"colorants capillaires" , "description"=>"description colorants capillaires",
                "prix_vente"=>80 , "prix_achat"=>70,
                "prix_unitaire"=>60 , "quantite"=>15,
                "created_at"=>Carbon::now() , "updated_at"=>Carbon::now(),
            ],
            [
                "categorie_id"=>3 , "reference"=>Str::upper("b-005"),
                "designation"=>"dépilatoires" , "description"=>"",
                "prix_vente"=>50 , "prix_achat"=>40,
                "prix_unitaire"=>30 , "quantite"=>15,
                "created_at"=>Carbon::now() , "updated_at"=>Carbon::now(),
            ]


        ];

        Produit::insert($data);
    }
}
