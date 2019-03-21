<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $table = 'list_cities';
    protected $fillable = ['city_id', 'city_name', 'city_code'];

    public static function getListCity() {
        $sql = Cities::all();
        return $sql;
    }

    public function getCityById($city_id) {
        $sql = $this->where('city_id', '=' , $city_id)->get();
        return $sql;
    }

    public static function getNameCityFrom($from)
    {
        return Cities::where('city_id', $from)->first();
    }

    public static function getTest($from2)
    {
        return Cities::where('city_id', $from2)->first();
    }

    public static function getNameCityTo($to)
    {
        return Cities::where('city_id', $to)->first();
    }
}
