<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table   = 'user_profile';
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function saveRaw($raw = null)
    {
        $defaultRaw = [
            "todayFood"     => 0,
            "todayExercise" => 0,
            "todayVelocity" => 0,
            "todayDistance" => 0,
            "todayTime"     => 0,
            "todayCalories" => 0,
        ];
        if ($this->raw === null || $this->raw === "") {
            $this->raw = json_encode($defaultRaw);
        }
        if ($raw != null) {
            $this->raw = $raw;
        }
        $this->save();
        return $this->raw;
    }
}
