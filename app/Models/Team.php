<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    protected $dates = [
        'last_submit'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function ban()
    {
        $this->baned = !$this->baned;
        $this->save();
    }

    public function up()
    {
        $this->last_submit = Carbon::now();
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
}
