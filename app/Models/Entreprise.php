<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;
    protected $table='entreprises';
    protected $fillable=["logo","raison_social","rc","ice","if","patente","site","cnss","adresse","ville","email","code_postal","telephone","fix"];
    public function getRouteKeyName()
    {
        return "ice";
    }
}
