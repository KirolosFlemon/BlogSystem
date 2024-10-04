<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Post\PostResource;
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
            'id' => $this->id,
            'name' => $this->title ?? null,
            'email' => $this->content ?? null,
            'image' =>  $this->image ?? null,
            'phone' =>  $this->phone ?? null,
            'posts' => $this->whenLoaded('user', function () {
                return  PostResource::collection($this->Post);
            }),

        ];
    }
}
