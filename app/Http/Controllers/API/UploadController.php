<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Upload;
use App\Http\Requests\StoreUploadRequest;
use App\Http\Requests\UpdateUploadRequest;
use App\Http\Resources\UploadResource;
use Exception;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UploadResource::collection(Upload::with('user')->paginate(25));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUploadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUploadRequest $request)
    {
        if($request->hasFile('attachment')){
            $upload = new Upload;
            try{
                $file=$request->file('attachment');
                $upload->type = $request->type;
                $upload->user_id = auth()->id();
                $upload->path = $file->store('uploads');
                $upload->name = $file->getClientOriginalName();
                $upload->size = $file->getSize();
                $upload->extension = strtolower($file->getClientOriginalExtension());
            }catch(Exception $e){
                return $this->failure($e->getMessage());
            }
            if($upload->save()){
                return $this->success('File successfully uploaded!',  ['data'=>new UploadResource($upload->with('user'))]);
            }
        }else{
            return $this->failure('File not found!', 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function show(Upload $upload)
    {
        return new UploadResource($upload->with('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function edit(Upload $upload, UpdateUploadRequest $request)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUploadRequest  $request
     * @param  \App\Models\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUploadRequest $request, Upload $upload)
    {
        if($request->hasFile('attachment')){
            try{
                $file=$request->file('attachment');
                $upload->type = $request->type;
                $upload->user_id = auth()->id();
                $upload->path = $file->store('uploads');
                $upload->name = $file->getClientOriginalName();
                $upload->size = $file->getSize();
                $upload->extension = strtolower($file->getClientOriginalExtension());
            }catch(Exception $e){
                return $this->failure($e->getMessage());
            }
            if($upload->save()){
                return $this->success('File successfully uploaded!',  ['data'=>new UploadResource($upload->with('user'))]);
            }
        }else{
            return $this->failure('File not found!', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function destroy(Upload $upload)
    {
        if(@unlink(public_path().DIRECTORY_SEPARATOR.str_replace('\\',DIRECTORY_SEPARATOR, $upload->path))){
            $upload->delete();
            return $this->success('File successfully removed!');
        }else{
            return $this->failure('File not found!', 404);
        }
    }
}
