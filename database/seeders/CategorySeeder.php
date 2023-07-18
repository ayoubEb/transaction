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
                "nom"=>"Beauté & Santé",
                "description"=>"La catégorie Beauté comprend produits et services pour prendre soin de sa peau, de ses cheveux et de son corps afin d'améliorer son apparence physique.",
                "created_at"=>Carbon::now(),
            ],
            [
                "nom"=>"Animaux de compagnie",
                "description"=>"La catégorie Animaux de compagnie englobe les espèces domestiques comme les chiens et les chats et comprend produits, services et informations pour leur santé et leur bien-être.",
                "created_at"=>Carbon::now(),
            ],
            [
                "nom"=>"Vêtements",
                "description"=>"La catégorie Vêtements comprend des articles en tissu pour se couvrir, se protéger ou se conformer, allant de vêtements de sport à des accessoires de cérémonie.",
                "created_at"=>Carbon::now(),
            ],
            [
                "nom"=>"Alimentation",
                "description"=>"La catégorie Alimentation comprend nourriture, boissons, aliments de base, compléments alimentaires et régimes alimentaires spécifiques.",
                "created_at"=>Carbon::now(),
            ],
            [
                "nom"=>"Boisson",
                "description"=>"La catégorie Boisson regroupe les boissons consommées pour se désaltérer, se régaler et profiter de leurs vertus nutritionnelles ou relaxantes, comme les sodas, les jus, les thés, les cafés, les bières et les vins.",
                "created_at"=>Carbon::now(),
            ],
            [
                "nom"=>"Maison",
                "description"=>"La catégorie Maison englobe les espaces de vie résidentiels tels que les maisons, les appartements et les maisons de vacances, ainsi que les articles et accessoires pour la décoration et le fonctionnement de ces espaces.",
                "created_at"=>Carbon::now(),
            ],
            [
                "nom"=>"Jardin",
                "description"=>"La catégorie Jardin regroupe les espaces verts et la végétation cultivée à des fins récréatives",
                "created_at"=>Carbon::now(),
            ],
            [
                "nom"=>"Sports & Loisirs",
                "description"=>"La catégorie Sports inclut les activités physiques pratiquées à des fins de loisirs, de compétition ou de santé, telles que le football, le tennis, la gymnastique, la natation et le jogging.",
                "created_at"=>Carbon::now(),
            ],
            [
                "nom"=>"Électronique",
                "description"=>"La catégorie Électronique comprend des dispositifs électroniques utilisés pour la communication, le divertissement et les tâches pratiques, tels que les smartphones, les ordinateurs, les tablettes et les téléviseurs.",
                "created_at"=>Carbon::now(),
            ],
            [
                "nom"=>"Bébé & Jouets",
                "description"=>"",
                "created_at"=>Carbon::now(),
            ],
            [
                "nom"=>"Informatique",
                "description"=>"",
                "created_at"=>Carbon::now(),
            ]














        ];
        Categorie::insert($data);

    }
}
