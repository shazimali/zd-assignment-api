<?php

namespace App\Http\Resources\API;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\API\UsersListResource;

class TaskDetailResource extends JsonResource
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
            'user' => $this->user,
            'status' => $this->status,
            'created_at' => $this->created_at->diffForHumans(),
            'workers' => WorkersListResource::collection(User::where('type','WORKER')->get())
        ];
    }
}
