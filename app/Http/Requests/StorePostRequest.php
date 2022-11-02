<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StorePostRequest extends FormRequest
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
            'name'=>['required', 'string'],
            'description'=>['required'],
            'cover_url'=>['required'],
            'video'=>['required' ]
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
            'name.required' => __('Title is required'),
            'name.string' => __('Title should be in human readable format'),
            'description.required' => __('Description is required'),
            'cover_url.required' => __('Please upload cover image'),
            'video.required' => __('Please upload video'),
        ];
    }
}
