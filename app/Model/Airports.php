<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airports extends Model
{
    protected $table = 'airports';
    protected $fillable = ['airport_id', 'airport_name', 'airport_code', 'airport_city_id', 'airport_province_id'];
}
