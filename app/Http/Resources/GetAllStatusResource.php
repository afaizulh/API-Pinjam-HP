<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetAllStatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>$this->id,
            'phone_name' => $this->phone_name,
            'status' => $this->status,
            'pemilik' => $this->pemilik['name'],
            'feedback' => FeedbackResource::collection($this->feedback)
        ];
    }
}
