<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flights_booking extends Model
{
    protected $table = 'flights_booking';
    protected $fillable = ['booking_id', 'user_id', 'fb_flight_id',
    'total_price', 'Payment_Method', 'card_number', 'card_name', 'ccv_code'];


    public function getBookById($user_id)
    {
        $sql = this::where('user_id', $user_id)->get();
        return $sql;
    }
}
