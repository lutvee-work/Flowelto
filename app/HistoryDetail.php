<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryDetail extends Model
{
    protected $fillable = [
        'history_id', 'flower_id', 'quantity', 'subtotal'
    ];
}
