<?php

namespace App\Http\Resources\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'picture' => $this->picture,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'dateCreated' => $this->created_at->diffForHumans(),
        ];
    }
}
