<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UploadResource extends JsonResource
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
            'author'=>new UserResource($this->whenLoaded('user')),
            'type'=>$request->type,
            'path'=>$request->path,
            'name'=>$request->name,
            'size'=>$request->size,
            'extension'=>$request->extension,
        ];
    }
}
