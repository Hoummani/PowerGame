<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use Validator;

class RestController extends Controller
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
        $games=Game::all();
        
        $result=$games->toArray();
        $message="Read successfuly !";
        $statusResult=true;
        return $this->sendResponse($result,$message,$statusResult);
    }

    public function store(Request $request){
        $inputs=$request->all();
        $validator=Validator::make($inputs,[
            'winer_id'=>'required',
            'loster_id'=>'required',
            'begin_at'=>'required|date',
            'end_at'=>'required|date'
        ]);
        if ($validator->fails()) {
            # code...
            $result=$validator->errors();
            $message="Validaion match error  :( !";
            $statusResult=false;
            return $this->sendResponse($result,$message,$statusResult);
        }
        $game=Game::create($inputs,[
            'winer_id'=>$request->winer_id,
            'loster_id'=>$request->loster_id,
            'begin_at'=>$request->begin_at,
            'end_at'=>$request->end_at
            
        ]);
        
        $result=$game->toArray();
        $message="game created successfly!";
        $statusResult=true;
        return $this->sendResponse($result,$message,$statusResult);
    }

    public function show($id){

        $game=Game::find($id);

        if (is_null($game)) {
            # code...
            $result=[];
            $message="game not found !";
            $statusResult=false;
            return $this->sendResponse($result,$message,$statusResult);
        }
        $result=$game->toArray();
        $message="game is here !";
        $statusResult=true;
        return $this->sendResponse($result,$message,$statusResult);

    }



    public function update(Request $request,Game $game){
        $inputs=$request->all();
        $validator=Validator::make($inputs,[
            'winer_id'=>'required',
            'loster_id'=>'required',
            'begin_at'=>'required',
            'end_at'=>'required'
        ]);
        if ($validator->fails()) {
            # code...
            $result=$validator->errors();
            $message="Validaion match error  :( !";
            $statusResult=false;
            return $this->sendResponse($result,$message,$statusResult);
        }
        $game->winer_id=$inputs['winer_id'];
        $game->loster_id=$inputs['loster_id'];
        $game->begin_at=$inputs['begin_at'];
        $game->end_at=$inputs['end_at'];
        
        $game->save();
        $result=$game->toArray();
        $message="Game updated with happy moments hhhhh !";
        $statusResult=true;
        return $this->sendResponse($result,$message,$statusResult);
    }

    public function destroy(Game $game){
        $game->delete();
        $result=$game->toArray();
        $message="Game deleted with sorry for going ): !";
        $statusResult=true;
        return $this->sendResponse($result,$message,$statusResult);
    }


}
