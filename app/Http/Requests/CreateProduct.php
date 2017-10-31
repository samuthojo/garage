<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProduct extends FormRequest
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
      'category_id' => 'required|integer',
      'name' => 'required',
      'car_id' => 'nullable|integer',
      'car_model_id' => 'nullable|integer',
      'unit' => 'required',
      'price' => 'required|integer',
      'stock' => 'required|integer',
      'has_includes' => 'required|boolean',
      'includes' => 'nullable|required_if:has_includes,==,1',
      'include_price' => 'nullable|required_if:has_includes,==,1|integer',
      'warranty' => 'nullable',
      'image' => 'nullable|file|image|max:2048',
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
      'category_id.required' => 'A category is required',
      'category_id.integer' => 'Please select a category',
      'name.required'  => 'Please enter product name',
      'car_id.integer' => 'Please select a car',
      'car_model_id.integer' => 'Please select a car_model',
      'unit.required' => 'Please enter the product unit',
      'price.required' => 'Please enter product price',
      'price.integer' => 'Product price must be a number',
      'stock.required' => 'Please enter the product stock',
      'stock.integer' => 'Product stock must be a number',
      'has_includes.required' => 'Please specify whether a product has includes or not',
      'has_includes.boolean' => 'Please specify whether a product has includes or not',
      'includes.required_if' => 'Please enter the includes',
      'include_price.required_if' => 'Please enter the include_price',
      'include_price.integer' => 'Include-price must be a valid integer',
      'image.file' => 'Errors during image upload, please try again',
      'image.image' => 'Image extensions allowed are: jpeg, jpg, png',
      'image.max' => 'Image exceeds maximum size of 2MB',
  ];
}

}
