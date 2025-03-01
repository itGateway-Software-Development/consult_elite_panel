<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title_eng' => $this->title_eng,
            'title_mm' => $this->title_mm,
            'date' => $this->date,
            'content_eng' => $this->content_eng,
            'content_mm' => $this->content_mm,
            'image' => $this->images ? asset('storage'. $this->images[0]->image) : null
        ];
    }
}
