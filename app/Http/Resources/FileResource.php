<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\FileNotFoundException;

class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $size = '';
        $md5sum = 'file not found';
        try {
            $size = Storage::size('attachment/' . $this->name) . ' kb';
            $md5sum = md5_file(storage_path('app/attachment/' . $this->name));
        } catch (\Exception $e ) {
            if ($e instanceof FileNotFoundException){
                $size = '0 kb';
            }
        }

        return [
            'name' => $this->name,
            'size' => $size,
            'md5sum' => $md5sum,
        ];
    }
}
