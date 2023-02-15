<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMaster extends Model
{
    use HasFactory;
    protected $table = 'ticket_masters';

    public function TicketDetail(){
        
        return $this->hasOne('App\Models\TicketDetail','ticket_master_id','id');
    }

}
