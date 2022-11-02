<?php

namespace App\Service;

use App\Models\Upload;

class UploadService
{
    /**
     * Transform the resource into an array.
     *
     * @param  String  $ids
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    static function convertPhotos(String $ids){
        $data=explode(',', $ids);
        $result = [];
        foreach ($data as $item) {
            if($url=self::assetUrl($item))
                $result[]=$url;
        }
        return $result;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  string  $id
     * @return string|null
    */
    static function assetUrl($id){
        if($upload=Upload::find($id)){
            return $upload->path;
        }
        return null;
    }
}
