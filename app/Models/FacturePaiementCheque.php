<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class FacturePaiementCheque extends Model
{
    use HasFactory;
    protected $table = "facture_paiement_cheques";
    protected $guarded =  [];
    /**
     * Get the paiement that owns the FacturePaiementCheque
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paiement(): BelongsTo
    {
        return $this->belongsTo(FacturePaiement::class, 'facture_paiement_id');
    }
    /**
     * Get the bancaire that owns the FacturePaiementCheque
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bancaire(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

}
