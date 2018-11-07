<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Challenge extends Model
{
    protected $fillable = ['category_id', 'name', 'description', 'flag', 'point', 'submission_limit', 'is_visible', 'point_mode', 'decay', 'minimum'];
    private $solve = 0;

    protected $casts = [
        'visible' => 'boolean'
    ];

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

    public function hide()
    {
        $this->is_visible = !$this->is_visible;
        $this->save();
    }

    public function solved()
    {
        return Auth::user()->submission->where('flag', $this->flag)->where('challenge_id', $this->id)->count() != 0;
    }

    public function remain()
    {
        if ($this->point_mode === 'static') {
            return $this->point;
        } else {
            if ($this->decay == 0)
                $this->decay = 1;
            $dynamic = ceil(((($this->minimum - $this->point) / ($this->decay ** 2)) * (($this->solve() - 1) ** 2)) + $this->point);

            return $dynamic < $this->minimum ? $this->minimum : $dynamic;
        }
    }
}
