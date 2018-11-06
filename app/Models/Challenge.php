<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Challenge extends Model
{
    protected $fillable = ['category_id', 'name', 'description', 'flag', 'point', 'submission_limit', 'visibly', 'point_mode'];
    private $solve = 0;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attachment()
    {
        return $this->hasMany(Attachment::class, 'challenge_id', 'id');
    }

    public function submission()
    {
        return $this->hasMany(Submission::class);
    }

    public function solve()
    {
        $this->solve = 0;
        $this->submission()->each(function ($item) {
            if ($item->correct())
                $this->addSolve();

        });
        return $this->solve;
    }

    private function addSolve()
    {
        $this->solve++;
    }

    public function hint()
    {
        return $this->hasMany(Hint::class);
    }

}
