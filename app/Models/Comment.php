<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $table = "comment";

    public function ticket(){
        return $this->belongsTo('App\Models\Ticket', 'ticket_id', 'id');
    }
}
