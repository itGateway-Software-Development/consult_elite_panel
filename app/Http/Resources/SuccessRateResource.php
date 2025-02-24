<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SuccessRateResource extends JsonResource
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
            'rate_count_eng' => $this->rate_count_eng,
            'rate_count_mm' => $this->rate_count_mm,
            'description_eng' => $this->description_eng,
            'description_mm' => $this->description_mm,
        ];
    }
}
