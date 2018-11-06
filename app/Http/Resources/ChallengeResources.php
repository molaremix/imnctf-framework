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
        return [
            'text' => $this->name,
            'href' => Auth::guard('admin')->check() ? route('admin.challenge.show', $this) :  route('challenge.show', $this),
            'data' => [
                'description' => $this->description,
                'point' => $this->point,
                'name' => $this->name,
                'files' => FileResource::collection($this->attachment)
            ]
        ];
    }
}
