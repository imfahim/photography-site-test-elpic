<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;
use Session;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;

class ImageController extends Controller
{
    //

    public function show_image($id,$file_name){
      return Storage::get('public/'.$id.'/'.$file_name);
    }

    public function download(Request $request){
      $invite=DB::table('invites')->where('token',$request->input('token'))->first();
      if($invite->invited_to_email==Session::get('logged_email')){
        $img=DB::table('images')->where('img_id',$invite->img_id)->first();
        $data['full_name']=Session::get('logged_name');
        $data['email']=Session::get('logged_email');
        $data['friend_email']=DB::table('users')->select('email')->where('id',$img->user_id)->first()->email;
        $data['image_title']=$img->title;
        Mail::send('complete',$data,function($message) use($data){
          $message->to($data['friend_email']);
          $message->subject('Invited Image Downladed');
        });

        if(!$img->visibility){
          //public
          //return Storage::download('public/'.$img->user_id.'/'.$img->title);
          return response()->download(storage_path('app\public\21\\') . $img->title);
        }
        else{
          //private
          return response()->download(storage_path('app\21\\') . $img->title);
        //  return Storage::download($img->user_id,$img->title);
        }

      }
      else{
        Session::flash('fail', 'Not the right User invited to download');
        return redirect('/app');

      }


    }

    public function upload(Request $request){
      //$data=json_decode($request->getContent(),true);
      //dd($request->file('file')->getClientMimeType());

      $rules=[
        'title'=>'required|min:6',
        'disc' =>'required',
        'status' => 'required'
      ];

      $val=Validator::make($request->all(),$rules);
      if($val->passes()){
        if($request->input('status')==0){
          $path = $request->file('file')->storeAs('public/'.Session::get('logged_id'), $request->input('title').'.'.$request->file('file')->getClientOriginalExtension());
        }
        else{
          $path = $request->file('file')->storeAs(Session::get('logged_id'), $request->input('title').'.'.$request->file('file')->getClientOriginalExtension());

        }
      //  $path = $request->file('avatar')->store('avatars/'.$request->user()->id, 's3');
    //  Storage::put('file.jpg', $request->file('file'), 'private');
        //  Storage::putFileAs($request->file('title'), $request->file('file'));
        DB::table('images')->insert([
          'user_id'=>Session::get('logged_id'),
          'title'=>$request->input('title').'.'.$request->file('file')->getClientOriginalExtension(),
          'description'=>$request->input('disc'),
          'visibility' =>$request->input('status'),
        ]);
      //  error_log($request);
        return response()->json(array('success'=>true,'message' => 'Succesfully Uploaded'));
      }
      else{
        return response()->json($val->messages(), 200);
      }
    }

    public function getImages(){
      $pub_images = DB::table('images')->where('user_id',Session::get('logged_id'))->where('visibility',0)->get();
      $pri_images = DB::table('images')->where('user_id',Session::get('logged_id'))->where('visibility',1)->get();
      //$file =base64_encode(Storage::get('21/privatepic.png'));
    //  return response($file,200)->header('Content-Type','image/png');
    //return response()->json(array('filel'=>$file),200);
      return response()->json(array('success'=>true,'pub_images'=>$pub_images,'pri_images'=>$pri_images),200);

    }
    public function priv_image($id,$file_name){
      if(Session::has('logged_id')){
        return Storage::get($id.'/'.$file_name);
      }
    }
}
