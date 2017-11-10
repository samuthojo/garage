<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateModel extends FormRequest
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
          'model_name' => 'required',
          // 'picture' => 'nullable|file|image|max:2048',
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
        'model_name.required'  => 'Please enter the model name',
        // 'picture.file' => 'Errors during picture upload, please try again',
        // 'picture.image' => 'Picture extensions allowed are: jpeg, jpg, png',
        // 'picture.max' => 'Picture exceeds maximum size of 2MB',
    ];
  }
}
