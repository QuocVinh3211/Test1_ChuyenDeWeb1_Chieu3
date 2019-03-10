<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transit extends Model
{
    protected $table = 'transit';
    protected $fillable = ['bill_id', 'product_id', 'quantily', 'price'];
    
    public $timestamps = false;
}
