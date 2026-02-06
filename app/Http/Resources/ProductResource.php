<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description ?? "N/A",
            'price' => round($this->price, 2),
            'tax_cost' => round($this->price, 2),
            'manufacturing_cost' => round($this->manufacturing_cost, 2),
        ];
    }
}
