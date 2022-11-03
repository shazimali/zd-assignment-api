<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class TasksListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->_id,
            'title' => $this->title,
            'des' => $this->desc,
            'image_path' => $this->image_path ? env('APP_URL').'storage/'.$this->image_path : env('APP_URL').'images/no-image.jpeg',
            'user' => $this->user->name,
            'status' => $this->status,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
