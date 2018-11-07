<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = ['title', 'description', 'start', 'finish', 'freeze'];

    protected $dates = [
        'created_at',
        'updated_at',
        'start',
        'finish',
    ];
}
