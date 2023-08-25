<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $permissions=[
   


             'categorie-create','categorie-edit','categorie-list','categorie-show','categorie-destroy',
        'sousCategorie-list','sousCategorie-create','sousCategorie-edit','sousCategorie-destroy',
        'caracteristique-list','caracteristique-create','caracteristique-edit','caracteristique-destroy',
        'stock-list','stock-create',"stock-show",'stock-destroy',


        "customize-facture","customize-stock",

        'facturePaiement-create','facturePaiement-list','facturePaiement-destroy',

        "stockHistory-list","stockHistory-destroy","stockHistory-create",

        'groupe-create','groupe-edit','groupe-list','groupe-destroy',
        'client-create','client-edit','client-list','client-show','client-destroy',
        'produit-create','produit-edit','produit-list','produit-show','produit-destroy',
        'facture-create','facture-edit','facture-list','facture-show','facture-destroy',
        'user-create','user-edit','user-list','user-show','user-destroy',
        'role-create','role-edit','role-list','role-show','role-destroy',
        'entreprise-create','entreprise-edit','entreprise-list','entreprise-destroy',
        "transaction-edit","transaction-destroy","transaction-create","transaction-list",
        "venteSemaine-list","venteSemaine-destroy","venteSemaine-show","venteSemaine-create","venteSemaine-edit",
        "typeClient-edit","typeClient-destroy","typeClient-create","typeClient-list",

        "avoire-list","avoire-create","avoire-edit","avoire-destroy","avoire-show",


        ];
        foreach($permissions as $permission){
            Permission::create(["name"=>$permission]);
        }
    }
}
