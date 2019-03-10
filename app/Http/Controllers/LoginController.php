<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
use Hash;

class LoginController extends Controller
{

     // chuc nang login
     public function authenticate(Request $request)
     {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
         // du lieu nhap vao
        $email = $request->email;
        $password = $request->password;
        $date_now = date('Y-m-d h:i:s');
         $getUser = User::where('email', '=' , $email)->first();
         
        if(isset($getUser))
        {
           $attempt = $getUser->attempt;   
           $last_access = $getUser->last_access;
        }
        else {
           
           // $attempt = $attempt + 1;
           // User::where('email' , '=', $email)->update(['attempt' => $attempt, 'last_access' => $date_now]);
           $mess = "Email không tồn tại nhé ^^!";
           return view('front-end.login', ['mess' => $mess]);
           
        }
        // dd(session()->get('url.intended'));

        // neu dang nhap thanh cong
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            if($attempt > 2){ // dung nhung attempt qua 3 lan
                  if(strtotime($last_access) < strtotime($date_now) &&  strtotime($date_now) < (strtotime($last_access) + 1800)){
                     $mess = "Tài khoản đã bị khóa 30 phút.";
                    Auth::logout();
                    return view('front-end.login', ['mess' => $mess]);
                    //   dd("dang nhap qua 3 lan, dang trong thoi gian khoa");
                  }
                  else { // het thoi gian khoa
                      User::where('email' , '=', $email)->update(['attempt' => 0, 'last_access' => $date_now]);
                      return redirect(session()->get('url.intended')); // da day, neu dang nhap dung
                    //   dd("qua 3 lan, nhung het thoi gian khoa");
                  }
              }
              else { // attempt chua toi 3 lan
                  User::where('email' , '=', $email)->update(['attempt' => 0, 'last_access' => $date_now]);
                   return redirect(session()->get('url.intended'));
                 //dd("dang nhap dung, nhung sai chua qua 3 lan");
              }
        }
        else {
            if($attempt > 2)
            {
                $mess = "Bạn đã nhập sai mật khẩu quá 3 lần, tài khoản đã bị khóa 30 phút!";
                return view('front-end.login', ['mess' => $mess]);
            }
            else {
                $attempt = $attempt + 1;
                User::where('email' , '=', $email)->update(['attempt' => $attempt, 'last_access' => $date_now]);
                $mess = "Mật khẩu không đúng nhé";
                return view('front-end.login', ['mess' => $mess]);
            }
           
        }
     }
}



//  echo "thanh cong roi" . $date_now;
//  var_dump($user);

//  else {
//     echo "dang nhap that bai";
// }