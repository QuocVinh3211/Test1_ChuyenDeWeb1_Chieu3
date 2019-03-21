<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flights_Booking extends Model
{
    protected $table = 'flights_booking';
    protected $fillable = ['booking_id', 'user_id', 'fb_flight_id',
    'total_price', 'Payment_Method', 'card_number', 'card_name', 'ccv_code'];


    public static function getBookById($user_id)
    {
        $sql = Flights_Booking::
        leftjoin('flights', 'flights.flight_id', '=', 'flights_booking.fb_flight_id')->
        join('airways', 'airways.airways_id' , 'flights.airways_id')
        ->where('flights_booking.user_id', $user_id)->get();
        return $sql;
    }

    public static function deleteBookById($id) {
        return Flights_Booking::Where('booking_id', $id)->delete();
    }
}
