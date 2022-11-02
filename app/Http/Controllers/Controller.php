<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function success(String $message='Success', mixed $data=[], int $status=200){
        return response()->json([
            'success'   => true,
            'message'   => __($message),
            'data'      => $data
        ], $status);
    }

    public function failure(String $message='Failure', int $status=200, Array $data=[]){
        return response()->json([
            'success'   => false,
            'message'   => __($message),
            'data'      => $data
        ], $status);
    }
}
