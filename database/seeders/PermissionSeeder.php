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
        'categorie-create','categorie-edit','categorie-list','categorie-show','categorie-delete',
        'groupe-create','groupe-edit','groupe-list','groupe-show','groupe-delete',
        'client-create','client-edit','client-list','client-show','client-delete',
        'produit-create','produit-edit','produit-list','produit-show','produit-delete',
        'facture-create','facture-edit','facture-list','facture-show','facture-delete',
        'user-create','user-edit','user-list','user-show','user-delete',
        'role-create','role-edit','role-list','role-show','role-delete',
        'entreprise-create','entreprise-edit','entreprise-list','entreprise-show','entreprise-delete',
        "transaction-edit","transaction-destroy","transaction-create","transaction-list",
        "vente-semaine-list","vente-semaine-destroy","vente-semaine-show","vente-semaine-create",
        "type-client-edit","type-client-destroy","type-client-create","type-client-list",
        ];
        foreach($permissions as $permission){
            Permission::create(["name"=>$permission]);
        }
    }
}
