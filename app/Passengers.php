<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passengers extends Model
{
    protected $table = 'passengers';
    protected $fillable = ['passenger_id', 'passenger_title', 'passenger_first_name', 
    'passenger_last_name', 'passenger_user_id', 'passenger_fl_id'];

    // hiển thị tên passenger đã đặt
    public static function getPassengerById($user_id, $flight_id)
    {
        return Passengers::Where([
                                    ['passenger_user_id', '=' , $user_id],
                                    ['passenger_fl_id'  , '=' , $flight_id]
                                ])->get();
    }

    // hiển thị passenger form edit 
    public static function getPassenger($idPassenger)
    {
        return Passengers::Where('passenger_id', $idPassenger)->first();
    }

    // sửa thông tin passenger
    public static function postEditPassenger($passenger_id, $passenger_title, $first_name, $last_name)
    {
        return Passengers::Where(  'passenger_id', $passenger_id)->
                           update(['passenger_title'      => $passenger_title,
                                   'passenger_first_name' => $first_name,
                                   'passenger_last_name'  => $last_name
                                   ]);

    }
}
