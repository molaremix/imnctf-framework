<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
}
