<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'href' => snake_case(strtolower($this->name)),
            'data' => [
                'description' => $this->description,
                'point' => $this->point,
                'name' => $this->name
            ]
        ];
    }
}
