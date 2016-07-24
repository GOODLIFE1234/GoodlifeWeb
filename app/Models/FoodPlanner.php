<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodPlanner extends Model
{
    protected $table = 'food_planner';
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function food()
    {
        return $this->belongsTo('App\Models\Food', 'food_id');
    }
}
