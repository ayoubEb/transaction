<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Group extends Model
{
    use HasFactory;
    protected $table="groups";
    protected $guarded=[];
    // public function client(){
    //   return $this->hasMany(Cleint::class);
    // }
    /**
     * Get the client associated with the Group
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client(): HasOne
    {
        return $this->hasOne(Client::class);
    }
}
