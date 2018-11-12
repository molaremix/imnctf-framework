<?php

namespace App\Models;

use App\Http\Controllers\ScoreboardController;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function publicSubmission()
    {
        $about = About::orderBy('id', 'DESC')->first();
        if ($about != null)
            $freeze = $about->finish->subHours(4);
        else
            $freeze = Carbon::now();

        return $this->submission()->where('created_at', '<=', $freeze);
    }

    public function point()
    {
        /*$about = About::orderBy('id', 'DESC')->first();
        if ($about != null)
            $freeze = $about->finish->subHours(4);
        else
            $freeze = Carbon::now();



        $solved = DB::select('SELECT challenges.id as id FROM submissions JOIN teams on submissions.team_id=teams.id JOIN challenges ON submissions.challenge_id=challenges.id WHERE teams.id = ? and submissions.flag=challenges.flag', [$this->id]);
        $pts = 0;
        foreach ($solved as $challenge) {
            $pts += $points->get($challenge->id);
        }
        return $pts;*/
    }

}
