<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $fillable = ['category_id', 'name', 'description', 'flag', 'point', 'submission_limit', 'visibly', 'point_mode'];

    public function category()
    {
        return $this->hasOne(Category::class);
    }
}
