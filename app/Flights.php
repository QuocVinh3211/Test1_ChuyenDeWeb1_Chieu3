<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flights extends Model
{
    protected $table = 'flights';
    protected $fillable = ['flight_id', 'airway_id', 'flight_time_from', 'flight_time_to', 'flight_city_from',
     'flight_city_to', 'flight_transit', 'flight_direction', 'flight_price'];

     // get flight by id
    public static function getFlightById($flight_id)
    {
        return Flights::where('flight_id', $flight_id)
                        ->leftjoin('airways', 'airways.airways_id', 'flights.airways_id')
                        ->get();
    }

    // get search flight
    public static function getSearchFlight($from_city_id, $to_city_id)
    {
        return Flights::where([
                                ['flight_city_from_id','=', $from_city_id],
                                ['flight_city_to_id'  ,'=', $to_city_id]
                                ])
                        ->leftjoin('airways', 'airways.airways_id', 'flights.airways_id')
                        ->get();
    }
}
