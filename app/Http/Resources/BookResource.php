<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'auther_name' => $this->auther_name,
            'price' => $this->price,
            'descreption' => $this->descreption,
            'category' => $this->category->name,
        ];
    }
}
