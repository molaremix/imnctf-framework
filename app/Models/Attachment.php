<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\FileNotFoundException;

class Attachment extends Model
{
    protected $fillable = ['challenge_id', 'name'];

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    public function size()
    {
        $size = '';
        try {
            $size = Storage::size('attachment/' . $this->name) . ' kb';
        } catch (\Exception $e) {
            if ($e instanceof FileNotFoundException) {
                $size = '0 kb';
            }
        }
        return $size;
    }

    public function checksum()
    {
        $md5sum = 'file not found';
        try {
            $md5sum = md5_file(storage_path('app/attachment/' . $this->name));
        } catch (\Exception $e) {
        }

        return $md5sum;
    }
}
