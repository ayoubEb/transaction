<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
class Categorie extends Model
{
    use HasFactory;
    use HasRoles;
    use SoftDeletes;
    protected $table="categories";
    protected $guarded = [];
    // protected $dates = ["deleted_at"];


    /**
     * Get all of the sous_categorie for the Categorie
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sous(): HasMany
    {
        return $this->hasMany(SousCategorie::class);
    }
    public function produit()
    {
        return $this->hasOne(Produit::class);
    }
}
