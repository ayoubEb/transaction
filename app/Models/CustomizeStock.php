<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomizeStock extends Model
{
    use HasFactory;
    protected $table = "customize_stocks";
    protected $guarded = [];
}
