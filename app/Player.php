<?php

namespace App;

use App\Game;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    //


    public function game(){
        return $this->belongsTo('App\Game');
    }
}
