<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(TypeClientSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(SousCategorieSeeder::class);
        $this->call(CaracteristiqueSeeder::class);
        $this->call(FournisseurSeeder::class);
        $this->call(CustomizeSeeder::class);
        $this->call(BankSeeder::class);
        $this->call(StockSeeder::class);



        // \App\Models\User::factory(10)->create();
    }
}
