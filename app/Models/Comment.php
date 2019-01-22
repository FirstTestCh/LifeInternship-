<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $table = "comment";

    protected $fillable = ['content', 'admin_only'];

    public function ticket()
    {
        return $this->belongsTo('App\Models\Ticket', 'ticket_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
