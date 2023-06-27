<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Stock extends Model
{
    use HasFactory;
    protected $table="stocks";
    protected $fillable=["produit_id","type","date_mouvement","montant","entre","reste","date_stock"];
    /**
     * Get the produit that owns the Stock
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }

}
