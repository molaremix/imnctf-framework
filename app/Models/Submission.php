<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = ['challenge_id', 'flag', 'team_id'];

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function correct()
    {
        return $this->challenge['flag'] == $this['flag'];
    }
}
