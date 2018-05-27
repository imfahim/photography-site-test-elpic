<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
use Mail;
use Session;
use Validator;
//use Illuminate\Http\Request;


class InviteController extends Controller
{
    //
    public function send_invite(){
      $rules=[
        'friend_email'=>'required|email',
        'img_id'=>'required',

      ];
      $val=Validator::make(Request::all(),$rules);
      if($val->passes()){
        $data["full_name"]=Session::get("logged_name");
        $data['token']=str_random(25);
        $data['friend_email']=Request::input('friend_email');
        DB::table('invites')->insert([
          'invited_by_id'=>Session::get("logged_id"),
          'invited_to_email' =>Request::input('friend_email'),
          'img_id' => Request::input('img_id'),
          'token' => $data['token']
        ]);

        Mail::send('invite',$data,function($message) use($data){
          $message->to($data['friend_email']);
          $message->subject('Invitation to Download');
        });
        return response()->json(array('success'=>true,'message' => 'Invitation Sent!'));

      }
      else{
        return response()->json($val->messages(), 200);
      }
    }

    public function verifyInvite($token){
      $invite=DB::table('invites')->where('token',$token)->first();
      if(!is_null($invite)){
        $img=DB::table('images')->where('img_id',$invite->img_id)->first();
        if($img->visibility){
          //private
          return view('download')->withImg($img)->withInvite($invite)->withVisi("private")->withUrl(Request::root())->withToken($token);
        }
        else{
          //public
          return view('download')->withImg($img)->withInvite($invite)->withVisi("public")->withUrl(Request::root())->withToken($token);
        }

      }
      else{
        Session::flash('fail', 'invalid token');
        return redirect('/');
      }
    }
}
