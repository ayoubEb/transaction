<?php

namespace App\Http\Controllers;

use App\Models\CustomizeFacture;
use App\Models\CustomizeStock;
use Illuminate\Http\Request;

class CustomizeController extends Controller
{
    public function index(){
        $facture = CustomizeFacture::select("id","reference","numero","tva")->first();
        $stock = CustomizeStock::select("id","reference","numero")->first();
        return view("customize",[
            "facture"=>$facture,
            "stock"=>$stock,
        ]);
    }
}
