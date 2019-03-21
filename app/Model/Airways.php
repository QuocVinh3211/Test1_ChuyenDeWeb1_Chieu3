<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airways extends Model
{
    protected $table = 'airways';
    protected $fillable = ['airways_id', 'airways_name', 'airway_country_id'];
    public $timestamps = false;


    public static function getAirlineName($id)
    {
        return Airways::where('airways_id', $id)->first();
    }
}
