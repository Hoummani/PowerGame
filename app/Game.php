<?php

namespace App;

use App\Player;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    //

    public function players(){
        return $this->hasMany('App\Player');
    }
}
