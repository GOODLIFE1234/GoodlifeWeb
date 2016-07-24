<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExercisePlanner extends Model
{
    protected $table = 'exercise_planner';
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function exercise()
    {
        return $this->belongsTo('App\Models\Exercise', 'exercise_id');
    }
}
