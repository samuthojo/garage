<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateServiceFromExisting extends FormRequest
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
            'car_model_id' => 'nullable|integer|required_with:car_id',
            'price' => 'required|integer',
        ];
    }

    public function messages()
    {
      return [
        'service_id.required' => 'Please select a service',
        'car_id.integer' => 'Please select a car',
        'car_model_id.integer' => 'Please select a model',
        'car_model_id.required_with' => 'A specific model selected without selecting a specific car',
        'price.required' => 'Please enter the service price',
        'price.integer' => 'The price must be a valid integer',
      ];
    }}
