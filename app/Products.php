<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'image', 'name'
    ];

    public function flowers() {
        return $this->belongsToMany('App\Flowers');
    }
}
