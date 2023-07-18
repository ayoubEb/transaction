<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produit extends Model
{
    use HasFactory;
    protected $table = "produits";
    protected $guarded = [];
    use SoftDeletes;

    /**
     * Get all of the categories for the Produit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(ProduitCategorie::class);
    }
    /**
     * Get all of the categories for the Produit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sous_categories(): HasMany
    {
        return $this->hasMany(ProduitSousCategorie::class);
    }
    /**
     * Get all of the caracteristiques for the Produit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function caracteristiques(): HasMany
    {
        return $this->hasMany(ProduitCaracteristique::class);
    }
    /**
     * Get all of the stock for the Produit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function stock(): HasOne
    {
        return $this->hasOne(Stock::class);
    }





      public function getRouteKeyName()
      {
        return "reference";
      }

    }

