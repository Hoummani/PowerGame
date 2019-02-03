<?php

namespace App\Http\Controllers;

use App\Player;
use Validator;
use Illuminate\Http\Request;

class RestPlayerController extends Controller
{
    //
    public function sendResponse($result,$message,$statusResult){

        $response=[
            'status'=>$statusResult,
            'data'=>$result,
            'message'=>$message
        ];

        return response()->json($response);

    }

    public function index(){
        $players=Player::all();
        
        $result=$players->toArray();
        $message="Read successfuly !";
        $statusResult=true;
        return $this->sendResponse($result,$message,$statusResult);
    }


    public function store(Request $request){
        $inputs=$request->all();
        $validator=Validator::make($inputs,[
            'game_id'=>'required',
            'fullName'=>'required',
            'score'=>'required'
        ]);
        if ($validator->fails()) {
            # code...
            $result=$validator->errors();
            $message="Validaion match error  :( !";
            $statusResult=false;
            return $this->sendResponse($result,$message,$statusResult);
        }
        $player=Player::create($inputs,[
            'game_id'=>$request->game_id,
            'fullName'=>$request->fullName,
            'score'=>$request->score
            
        ]);
        
        $result=$player->toArray();
        $message="player created successfly!";
        $statusResult=true;
        return $this->sendResponse($result,$message,$statusResult);
    }



    public function show($id){

        $player=Player::find($id);

        if (is_null($game)) {
            # code...
            $result=[];
            $message="player not found !";
            $statusResult=false;
            return $this->sendResponse($result,$message,$statusResult);
        }
        $result=$player->toArray();
        $message="Player is here !";
        $statusResult=true;
        return $this->sendResponse($result,$message,$statusResult);

    }

    public function update(Request $request,Player $player){
        $inputs=$request->all();
        $validator=Validator::make($inputs,[
            'game_id'=>'required',
            'fullName'=>'required',
            'score'=>'required'
        ]);
        if ($validator->fails()) {
            # code...
            $result=$validator->errors();
            $message="Validaion match error  :( !";
            $statusResult=false;
            return $this->sendResponse($result,$message,$statusResult);
        }
        $player->game_id=$inputs['game_id'];
        $player->fullName=$inputs['fullName'];
        $player->score=$inputs['score'];
        //$player->end_at=$inputs['end_at'];
        
        $player->save();
        $result=$player->toArray();
        $message="Player updated with happy moments hhhhh !";
        $statusResult=true;
        return $this->sendResponse($result,$message,$statusResult);
    }

    public function destroy(Player $player){
        $player->delete();
        $result=$player->toArray();
        $message="Player deleted with sorry for going ): !";
        $statusResult=true;
        return $this->sendResponse($result,$message,$statusResult);
    }
}
