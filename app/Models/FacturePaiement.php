<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
class FacturePaiement extends Model
{
    use HasFactory;
    protected $table = "facture_paiements";
    protected $guarded = [];
    /**
     * Get the user that owns the FacturePaiement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function facture(): BelongsTo
    {
        return $this->belongsTo(Facture::class, 'facture_id');
    }
    /**
     * Get the user that owns the FacturePaiement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    /**
     * Get the cheque associated with the FacturePaiement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cheque(): HasOne
    {
        return $this->hasOne(FacturePaiementCheque::class);
    }


}
