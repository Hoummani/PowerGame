<?php

namespace App;

use App\Player;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    //

    protected $fillable = [
        'winer_id', 'loster_id', 'begin_at','end_at'
    ];

    public function players(){
        return $this->hasMany('App\Player');
    }
}
