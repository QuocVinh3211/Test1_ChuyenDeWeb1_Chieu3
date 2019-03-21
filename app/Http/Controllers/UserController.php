<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;
use App\Flights_Booking;
use App\Airways;
use App\Cities;
use App\Passengers;

class UserController extends Controller
{
    public function getEdit()
    {
        return View('front-end.edit-user');
    }

    // sửa thông tin của user
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

    // sửa thông tin passenger
    public function postEditPassenger(Request $res){
        $passenger_id    = $res->passenger_id;
        $passenger_title = $res->passenger_title;
        $firstName       = $res->firstName;
        $lastName        = $res->lastName;
        Passengers::postEditPassenger($passenger_id, $passenger_title, $firstName, $lastName);

        $mess = "Cập nhât thành công!";
        return redirect('getPassenger/'.$passenger_id)->with('status', $mess);
    }

    // hiển thị thông tin passenger theo id
    public function getPassenger($idPassenger)
    {
        $sql = Passengers::getPassenger($idPassenger);
        return view('front-end.form-edit-passenger', ['passenger' => $sql]);
    }

    // xem chi tiết vé đã đặt
    public function getDetailBook()
    {
        if(Auth::check())
        {
            $user_id = Auth::user()->id;
        }

        $flight = Flights_Booking::getBookById($user_id);

        foreach($flight as $row) {
            $data['get_city_from'] = Cities::getNameCityTo($row->flight_city_from_id);
            $data['get_city_to'] = Cities::getNameCityFrom($row->flight_city_to_id);
            $data['get_airline'] = Airways::getAirlineName($row->airways_id);

            // lấy passenger đã đặt trong chuyến bay
            $passenger = Passengers::getPassengerById($row->user_id, $row->fb_flight_id);  
        }
        return view('front-end.flight-view-book', ['flight'    => $flight,
                                                   'data'      =>$data,
                                                   'passenger' => $passenger]);
    }

    // quản lý các vé đã đặt
    public function getViewBook()
    {
        if(Auth::check())
        {
            // lấy user_id đang đăng nhập
            $user_id = Auth::user()->id;

            // lấy các chuyến bay mà user đã đặt
            $sql = Flights_Booking::getBookById($user_id);
            $data = null;
        
            if(isset($sql)){
                foreach($sql as $row) {
                    $data['get_city_from'] = Cities::getNameCityTo($row->flight_city_from_id);
                    $data['get_city_to']   = Cities::getNameCityFrom($row->flight_city_to_id);
                }
    
            }

            return View('front-end.flight-user-book', ['flight' => $sql,
                                                        'data'  => $data]);
        }

    }

    // hủy vé đã đặt
    public function deleteBooked($id)
    {
        $sql = Flights_Booking::deleteBookById($id);
        $mess = "Xóa vé bay thành công!";
        return redirect()->route('viewBook')->with('status', $mess);
    }
}
