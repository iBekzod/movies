<?php

namespace App\Http\Resources;

use App\Service\UploadService;
use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
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
            'title'=>$request->name,
            'description'=>$request->description,
            'cover_url'=>UploadService::assetUrl($request->cover_url),
            'video'=>UploadService::assetUrl($request->video),
        ];
    }


}
