<?php

namespace App;

use App\Game;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    //

    protected $fillable = [
        'game_id', 'fullName','score'
    ];

    public function game(){
        return $this->belongsTo('App\Game');
    }
}
