<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

class UserController extends Controller
{
    public function getEdit()
    {
        return View('front-end.edit-user');
    }

    public function postEdit(Request $res)
    {
        $email    = $res->email;   
        $name     = $res->name;
        $password = $res->password;
        $newpass  = Hash::make($password);
        $phone    = $res->phone;
        $gender   = $res->gender;
        $bird     = $res->bird;
        $address  = $res->address;

        if($password == "") {
             User::where('email' , '=', $email)->update(['name'     => $name,
                                                        'user_phone'    => $phone,
                                                        'user_gender'   => $gender,
                                                        'user_bird'     => $bird,
                                                        'user_adress'  => $address]);
        }
        else {
            User::where('email' , '=', $email)->update(['name'     => $name,
            'password' => $newpass,
            'user_phone'    => $phone,
            'user_gender'   => $gender,
            'user_bird'     => $bird,
            'user_adress'  => $address]);
        }

       

        return redirect('getEdit');
    }
}
