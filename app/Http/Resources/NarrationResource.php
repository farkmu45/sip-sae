<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NarrationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'picture' => $this->picture,
            'content' => $this->content,
            'created_at' => $this->created_at
        ];
    }
}
