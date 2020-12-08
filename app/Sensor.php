<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $fillable = ['sensor','value', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
