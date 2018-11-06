<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
        return [
            'name' => $this->name,
            'size' => $size = Storage::size('attachment/' . $this->name) . ' kb',
            'md5sum' => $size = md5_file(storage_path('app/attachment/' . $this->name)),
        ];
    }
}
