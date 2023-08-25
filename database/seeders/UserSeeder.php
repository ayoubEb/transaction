<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $user = User::create([
        'name' => "belpre",
        "username"=>"manager",
        'email' => "belpre@gmail.com",
        'password' => Hash::make('123'),
        'image' => "user.jpg",
        'statut' => "activer",
    ]);
    $role = Role::create(['name' => 'Admin']);

    $permissions = Permission::pluck('id','id')->all();

    $role->syncPermissions($permissions);

    $user->assignRole([$role->id]);
    }

}
