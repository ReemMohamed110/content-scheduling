<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "title"=>$this->title,
            "content"=>$this->content,
            "image"=>$this->image_url,
            "status"=>$this->status,
            "user name"=>$this->user->name,
            "created at "=>$this->created_at->format('Y-m-d H:i:s'),];
    }
}
