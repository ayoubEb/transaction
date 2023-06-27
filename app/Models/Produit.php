<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Produit extends Model
{
    use HasFactory;
    protected $table = "produits";
    protected $guarded = [];

      /**
       * Get the categorie that owns the Produit
       *
       * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
       */
      public function categorie(): BelongsTo
      {
          return $this->belongsTo(Categorie::class, 'categorie_id');
      }

      public function getRouteKeyName()
      {
        return "reference";
      }

    }

