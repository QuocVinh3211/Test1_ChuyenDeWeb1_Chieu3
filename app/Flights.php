<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flights extends Model
{
    protected $table = 'flights';
    protected $fillable = ['flight_id', 'airway_id', 'flight_time_from', 'flight_time_to', 'flight_city_from',
     'flight_city_to', 'flight_transit', 'flight_direction', 'flight_price'];
}
