<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    protected $fillable = ['challenge_id', 'name'];

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    public function size()
    {
        return Storage::size('attachment/' . $this->name);
    }

    public function checksum()
    {
        return md5_file(storage_path('app/attachment/' . $this->name));
    }
}
