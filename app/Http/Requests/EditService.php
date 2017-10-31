<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditService extends FormRequest
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
            'service_id' => 'required|integer',
            'car_id' => 'nullable|integer',
            'car_model_id' => 'nullable|integer',
            'price' => 'required|integer',
            'description' => 'nullable|min:9',
            'picture' => 'nullable|file|image|max:2048',
        ];
    }

    public function messages()
    {
      return [
        'service_id.required' => 'Please select a service',
        'price.required' => 'Please enter the service price',
        'price.integer' => 'The price must be a valid integer',
        'description.min' => 'The description must have atleast 3 words',
        'picture.file' => 'Errors during image upload, please try again',
        'picture.image' => 'Image extensions allowed are: jpeg, jpg, png',
        'picture.max' => 'Image exceeds maximum size of 2MB',
      ];
    }
}
