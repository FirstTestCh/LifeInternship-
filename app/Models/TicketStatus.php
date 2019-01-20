<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
     public $table = "ticket_status";
     public $timestamps = false;

     public function tickets(){
          return $this->hasMany('App\Models\Ticket','ticket_status','id');
     }
}
