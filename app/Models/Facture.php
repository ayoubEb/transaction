<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Facture extends Model
{
    use HasFactory;
    protected $table='factures';
    protected $guarded = [];
    public function client(){
      return $this->belongsTo(Client::class, 'client_id');
    }
    public function entreprise(){
      return $this->belongsTo(Entreprise::class, 'entreprise_id');
    }
    public function facture_produit(){
      return $this->hasMany(FactureProduit::class, 'facture_id');
    }

    /**
     * Get the user associated with the Facture
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function paiement(): HasMany
    {
        return $this->hasMany(FacturePaiement::class, 'facture_id');
    }

    public function getRouteKeyName()
    {
        return "num_facture";
    }
}
