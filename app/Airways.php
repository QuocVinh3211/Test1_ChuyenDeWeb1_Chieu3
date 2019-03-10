<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airways extends Model
{
    protected $table = 'airways';
    protected $fillable = ['airways_id', 'airways_name'];
    public $timestamps = false;
}
