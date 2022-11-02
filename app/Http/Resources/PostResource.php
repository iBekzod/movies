<?php

namespace App\Http\Resources;

use App\Service\UploadService;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title'=>$request->name,
            'description'=>$request->description,
            'cover_url'=>UploadService::assetUrl($request->cover_url),
            'video'=>UploadService::assetUrl($request->video),
            'created_date'=>Carbon::parse($request->created_date)->format('d.m.Y H:i'),
            'comments'=> CommentResource::collection($this->whenLoaded('comments')),
            'children'=> PostDetailResource::collection($this->whenLoaded('children'))
        ];
    }
}
