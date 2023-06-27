<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class WeekAmount extends Model
{
    use HasFactory;
    protected $table = "week_amounts";
    protected $guarded = [];


    /**
     * Get all of the comments for the WeekAmount
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sales(): HasMany
    {
        return $this->hasMany(WeekAmountSale::class);
    }
    public function purchases(): HasMany
    {
        return $this->hasMany(WeekAmountPurchase::class);
    }

    public static function day($jour){
        switch($jour){
            case "Mon":
                echo "Lundi";
                break;
            case "Tue":
                echo "Mardi";
                break;
            case "Wed":
                echo "Mercredi";
                break;
            case "Thu":
                echo "Jeudi";
                break;
            case "Fri":
                echo "Vendredi";
                break;
            case "Sat":
                echo "Samedi";
                break;
            case "Sun":
                echo "Dimanche";
                break;
        }

    }
}
