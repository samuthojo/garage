<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCar extends FormRequest
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
            'name' => 'required',
            'num_models' => 'required|integer',
            'picture' => 'nullable|file|image|max:2048',
        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
      return [
          'name.required'  => 'Please enter the car name',
          'num_models.required' => 'Please enter the number of models',
          'num_models.integer' => 'Number of models must be a valid integer',
          'picture.file' => 'Errors during picture upload, please try again',
          'picture.image' => 'Picture extensions allowed are: jpeg, jpg, png',
          'picture.max' => 'Picture exceeds maximum size of 2MB',
      ];
    }

}
