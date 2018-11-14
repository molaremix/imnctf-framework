<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Challenge extends Model
{
    protected $fillable = ['category_id', 'name', 'description', 'flag', 'point', 'submission_limit', 'is_visible', 'point_mode', 'decay', 'minimum'];

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
        $query = DB::select('SELECT teams.name, submissions.created_at as time FROM submissions JOIN challenges ON submissions.challenge_id = challenges.id JOIN teams ON teams.id = submissions.team_id WHERE submissions.challenge_id = ? AND submissions.flag = challenges.flag
', [$this->id]);
        return $query;
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
        $query = DB::selectOne('SELECT COUNT(*) AS solved FROM submissions JOIN challenges ON submissions.challenge_id = challenges.id WHERE submissions.team_id =  ? AND submissions.challenge_id = ? AND submissions.flag = challenges.flag', [Auth::id(), $this->id]);
        return $query->solved > 0;
    }

    public function pts($solve = null)
    {
        if ($this->point_mode === 'static') {
            return $this->point;
        } else {
            if ($this->decay == 0)
                $this->decay = 1;
            $dynamic = ceil(((($this->minimum - $this->point) / ($this->decay ** 2)) * (($solve ?? count($this->solve()) - 1) ** 2)) + $this->point);

            return $dynamic < $this->minimum ? $this->minimum : $dynamic;
        }
    }

    public function submittedByMe()
    {
        return Submission::where('team_id', Auth::id())->where('challenge_id', $this->id)->count();
    }

    public function remain()
    {
        return $this->submission_limit - $this->submittedByMe();
    }
}
