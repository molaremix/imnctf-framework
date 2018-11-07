<?php

namespace App\Models;

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

    public function point()
    {
        $correct = new Collection();
        $this->submission()->each(function ($item) use ($correct) {
            if ($item->correct()) {
                $correct->put($item['challenge_id'], ['point' => $item->challenge->point()]);
            }
        });
        return $correct->sum('point');
    }
}
