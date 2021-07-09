<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'total',
        'name',
        'address',
        'mail',
        'status'
    ];

    public function plates() {
        return $this->belongsToMany('App\Plate');
    }
}
