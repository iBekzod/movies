<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateUploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'attachment' => [ 'required', 'mimes:jpg,jpeg,png,svg,webp,gif,mp4,mpg,mpeg,avi,mov,flv,swf,mkv']
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => __('Validation errors'),
            'data'      => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'attachment.required' => __('File is required'),
        ];
    }
}
