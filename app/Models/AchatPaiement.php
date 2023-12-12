<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class AchatPaiement extends Model
{
    protected $table = "achat_paiements";
    protected $guarded = [];
    use SoftDeletes;
    use HasFactory;


    /**
     * Get all of the cheques for the AchatPaiement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cheques(): HasMany
    {
        return $this->hasMany(AchatCheque::class);
    }

    /**
     * Get the founrnisseur that owns the AchatPaiement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fournisseur(): BelongsTo
    {
        return $this->belongsTo(Fournisseur::class, 'fournisseur_id');
    }
    /**
     * Get the founrnisseur that owns the AchatPaiement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ligne(): BelongsTo
    {
        return $this->belongsTo(LigneAchat::class, 'ligne_achat_id');
    }
}
