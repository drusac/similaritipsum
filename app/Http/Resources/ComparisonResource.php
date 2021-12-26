<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ComparisonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'string1' => $this->string1,
            'string2' => $this->string2,
            'matching_chars' => $this->matching_chars,
            'match_percentage' => $this->match_percentage,
        ];
    }
}
