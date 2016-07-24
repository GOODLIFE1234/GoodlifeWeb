<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserReport extends Model
{
    protected $table = 'userReport';
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
