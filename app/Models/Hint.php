<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hint extends Model
{
    protected $fillable = ['challenge_id', 'description'];

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }
}
