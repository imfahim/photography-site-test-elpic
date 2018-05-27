<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;
use Session;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //

    public function index(){
      if(Session::has('logged_id')){
        return redirect('/app');
      }
      else{
        return view('index');
      }
    }

    public function getUser(){
      $user=DB::table('users')->select('id','full_name','email','mobile_number','address')->where('id',Session::get('logged_id'))->first();
      return response()->json($user, 200);

    }
     public function register(Request $request){
      $this->validate($request, [
          'full_name' => 'required',
          'email' => 'required|email|unique:users,email',
          'password' => 'required|min:6',
          'cpassword' => 'required|min:6|same:password',
          'mobile_number' => 'required',
          'address' => 'required'
      ]);

      $id=DB::table('users')->insertGetId([
        'full_name' => $request->input('full_name'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
        'mobile_number' => $request->input('mobile_number'),
        'address' => $request->input('address')
      ]);
      $data['full_name']=$request->input('full_name');
      $data['email'] = $request->input('email');
      $data['password'] = $request->input('password');
      $data['mobile_number']= $request->input('mobile_number');
      $data['address'] = $request->input('address');
      $data['token']=str_random(25);

      DB::table('verify_users')->insert([
        'user_id'=>$id,
        'token'=>$data['token']
      ]);

      Mail::send('verifyUser',$data,function($message) use($data){
        $message->to($data['email']);
        $message->subject('Registration Confirmation');
      });
      Session::flash('success', 'Confirmation email has been send');
      return redirect('/');
    }


     public function verifyUser($token){
      $user=DB::table('verify_users')->where('token',$token)->first();
      if(!is_null($user)){
        $ch=DB::table('users')->where('id',$user->user_id)->first();
        if($ch->status==1){
          Session::flash('success', 'Already Confirmed');
          return redirect('/');
        }
        else{
          DB::table('users')->where('id',$user->user_id)->update(['status'=>1]);
          Session::flash('success', 'Successfully Confirmed.Please Log in');
          return redirect('/');
        }
      }
      else{
        Session::flash('fail', 'invalid token');
        return redirect('/');
      }
    }

    public function login(Request $request){
      $this->validate($request, [
          'email' => 'required|email',
          'password' => 'required'
      ]);

      $user=DB::table('users')->where('email',$request->input('email'))->first();
      if(!is_null($user)){
        if(Hash::check($request->input('password'), $user->password)){
          if($user->status){
            Session::put('logged_id',$user->id);
            Session::put('logged_name',$user->full_name);
            Session::put('logged_email',$user->email);

            return redirect('/app');
          }
          else{
            Session::flash('fail', 'Email not verified');
            return redirect('/');
          }
        }
        else{
          Session::flash('fail', 'Wrong Password');
          return redirect('/');
        }
      }
      else{
        Session::flash('fail', 'No User With this Email');
        return redirect('/');
      }

    }

    public function logout(){
      Session::flush();
      Session::flash('success', 'Successfully Logged Out');
      return redirect('/');
    }
}
