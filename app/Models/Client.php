<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table="clients";
    protected $guarded = [];
      /**
       * Get all of the comments for the Client
       *
       * @return \Illuminate\Database\Eloquent\Relations\HasMany
       */
      public function factures()
      {
          return $this->hasMany(Facture::class);
      }

      public function group()
      {
        return $this->belongsTo(Group::class, 'group_id');
      }

      public function type()
      {
        return $this->belongsTo(TypeClient::class, 'type_client_id');
      }

      public function getRouteKeyName()
      {
        return "ice";
      }

}
