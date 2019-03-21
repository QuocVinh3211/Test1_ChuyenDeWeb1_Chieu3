<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passengers extends Model
{
    protected $table = 'passengers';
    protected $fillable = ['passenger_id', 'passenger_title', 'passenger_first_name', 
    'passenger_last_name', 'passenger_user_id', 'passenger_fl_id'];
}
