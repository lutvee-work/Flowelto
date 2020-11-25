<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flowers extends Model
{
    protected $fillable = [
        'product_id', 'image', 'name', 'price', 'description'
    ];

    public function products() {
        return $this->belongsToMany('App\Products');
    }
}
