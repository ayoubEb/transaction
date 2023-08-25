<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeClient extends Model
{
    use HasFactory;
    protected $table = "type_clients";
    protected $guarded=[];
    use SoftDeletes;
}
