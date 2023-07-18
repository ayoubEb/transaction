<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmountPurchase extends Model
{
    use HasFactory;
    protected $table = "amount_purchases";
    protected $guarded = [];
}
