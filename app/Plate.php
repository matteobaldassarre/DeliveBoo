<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plate extends Model
{
    protected $table = 'plates';

    protected $fillable = [
        'name',
        'ingredients',
        'price',
        'slug',
        'visible',
        'user_id',
        'image',
        'type'
    ];

    public function orders() {
        return $this->belongsToMany('App\Order');
    }
}
