<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
     public $table = "ticket_category";
     public $timestamps = false;

     protected $fillable = ['name'];

     public function tickets()
     {
        return $this->hasMany('App\Models\Ticket','ticket_category','id');
     }
}
