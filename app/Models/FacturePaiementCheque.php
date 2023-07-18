<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturePaiementCheque extends Model
{
    use HasFactory;
    protected $table = "facture_paiements";
    protected $guarded =  [];

}
