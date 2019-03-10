<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flights_booking extends Model
{
    protected $table = 'flights_booking';
    protected $fillable = ['booking_id', 'user_id', 'flight_id',
    'total_price', 'Payment_Method', 'card_number', 'card_name', 'ccv_code'];

}
