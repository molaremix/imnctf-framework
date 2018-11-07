<?php

namespace App\Http\Resources;

use App\Models\Admin;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ChallengeResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $attrib = [
            'text' => $this->name,
            'href' => route('challenge.show', $this),
            'data' => [
                'description' => $this->description,
                'point' => $this->point,
                'name' => $this->name,
                'files' => FileResource::collection($this->attachment)
            ],
        ];
        if ($this->solved()) {
            $attrib['color'] = "#ffffff";
            $attrib['backColor'] = "#5ac146";
        }
        return $attrib;
    }
}
