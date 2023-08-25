<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entreprise extends Model
{
    use HasFactory;
    protected $table='entreprises';
    protected $guarded = [];
    use SoftDeletes;
    public function getRouteKeyName()
    {
        return "ice";
    }
}
