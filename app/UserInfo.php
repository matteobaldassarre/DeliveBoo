<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'restaurant_info';

    protected $fillable = [
        'restaurant_name',
        'address',
        'VAT',
        'cover'
    ];

    public function users() {
        return $this->belongsTo('App\User');
    }
}
