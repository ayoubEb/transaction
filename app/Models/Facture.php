<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facture extends Model
{
    use HasFactory;
    protected $table='factures';
    protected $guarded = [];
    use SoftDeletes;
    public function client(){
      return $this->belongsTo(Client::class, 'client_id');
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

    /**
     * Get the user associated with the Facture
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function produits(): HasMany
    {
        return $this->hasMany(FactureProduit::class);
    }

    /**
     * Get the entreprise that owns the Facture
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entreprise(): BelongsTo
    {
        return $this->belongsTo(Entreprise::class, 'entreprise_id');
    }
    public function getRouteKeyName()
    {
        return "num_facture";
    }
}
