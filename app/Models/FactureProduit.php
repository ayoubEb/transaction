<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactureProduit extends Model
{
    use HasFactory;
    protected $table='facture_produits';
    protected $guarded = [];
    public function facture(){
      return $this->belongsTo(Facture::class, 'facture_id');
    }
}
