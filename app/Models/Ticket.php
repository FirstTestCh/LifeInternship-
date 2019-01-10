<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public $table = "ticket";
    public $timestamps = false; 
    
    public function comments(){
        return $this->hasMany('App\Models\Comment','ticket_id','id');
    }

    public function category(){
        return $this->belongsTo('App\Models\TicketCategory','ticket_category','id');
    }
    
    public function status(){
        return $this->belongsTo('App\Models\TicketStatus','ticket_status','id');
    }

}
