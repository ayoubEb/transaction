<?php

namespace Database\Seeders;

use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1 ; $i<=121 ; $i++){
            $d[$i] =rand(30,1000);
            Stock::create([
                "produit_id"=>$i,
                "num"=>"STO00-".$i,
                "entre"=>$d[$i],
                "initial"=>$d[$i],
                "sortie"=>0,
                "reste"=>$d[$i],
                "min"=>1,
                "date_stock"=>Carbon::now(),
            ]);
        }

    }
}
