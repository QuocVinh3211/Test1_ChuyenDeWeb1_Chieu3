<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class List_cities extends Model
{
    protected $table = 'list_cities';
    protected $fillable = ['city_id', 'city_name', 'city_code'];
    public $timestamps = false;

    public function getCity($city_id) {
        $sql = $this->where('city_id', '=' , $city_id)->get();
        return $sql;
    }
}
