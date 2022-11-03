<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class UserDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($user)
    {
        return [
            'id' => $this->_id,
            'name' => $this->name,
            'email' => $this->email,
            'type' => $this->type,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
