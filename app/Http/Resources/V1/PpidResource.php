<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PpidResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'kategori' => self::collection($this->whenLoaded('children')),
            'files' => PpidItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
