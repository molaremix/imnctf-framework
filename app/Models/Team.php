<?php

namespace App\Models;

use App\Http\Controllers\ScoreboardController;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

class Team extends Authenticatable
{
    use Notifiable;

    protected $casts = [
        'verified' => 'boolean',
        'baned' => 'boolean',
    ];

    protected $fillable = [
        'name', 'email', 'password', 'verified', 'baned'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function ban()
    {
        $this->baned = !$this->baned;
        $this->save();
    }

    public function verify()
    {
        $this->verified = true;
        $this->save();
    }

    public function submission()
    {
        return $this->hasMany(Submission::class);
    }

    public function submissionBeforeFreeze()
    {
        $about = About::orderBy('id', 'DESC')->first();
        if ($about != null)
            $freeze = $about->finish->subHours(4);
        else
            $freeze = Carbon::now();

        return $this->submission()->where('created_at', '<=', $freeze);
    }

    public function pointUnfreeze()
    {
        $correct = new Collection();
        $this->submission()->each(function ($item) use ($correct) {
            if ($item->correct()) {
                $correct->put($item['challenge_id'], ['pts' => $item->challenge->remain()]);
            }
        });
        return $correct->sum('pts');
    }

    public function point()
    {
        $correct = new Collection();
        $this->submissionBeforeFreeze()->each(function ($item) use ($correct) {
            if ($item->correct()) {
                $correct->put($item['challenge_id'], ['point' => $item->challenge->remain()]);
            }
        });
        return $correct->sum('point');
    }

    public function rank()
    {
        $rank = Team::where('baned', '0')->get()->sortByDesc(function ($item) {
            return $item->point();
        })->search(function ($item) {
            return $item['id'] == 1;
        });

        return $rank + 1;
    }
}
