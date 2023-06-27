<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;
class Categorie extends Model
{
    use HasFactory;
    use HasRoles;
    protected $table="categories";
    protected $guarded = [];


    /**
     * Get all of the sous_categorie for the Categorie
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sous_categorie(): HasMany
    {
        return $this->hasMany(SousCategorie::class);
    }
    public function produit()
    {
        return $this->hasOne(Produit::class);
    }
}
