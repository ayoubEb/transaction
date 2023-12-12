<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LigneAchat extends Model
{
    protected $table = "ligne_achats";
    protected $guarded = [];
    use HasFactory;
    use SoftDeletes;
    /**
     * Get all of the achats for the LigneAchat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function achats(): HasMany
    {
        return $this->hasMany(Achat::class);
    }

    /**
     * Get the fournisseur that owns the LigneAchat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fournisseur(): BelongsTo
    {
        return $this->belongsTo(Fournisseur::class, 'fournisseur_id');
    }

    /**
     * Get the fournisseur that owns the LigneAchat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entreprise(): BelongsTo
    {
        return $this->belongsTo(Entreprise::class, 'entreprise_id');
    }

    /**
     * Get all of the paiements for the LigneAchat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paiements(): HasMany
    {
        return $this->hasMany(AchatPaiement::class);
    }
}
