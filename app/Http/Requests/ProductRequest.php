<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
           'name' => 'required | min:3',
           'description' => 'required | max:200',
           'price' => 'required | numeric | min:0'
        ];
    }

   public function messages()
   {
      return [
         'name.required' => 'El nombre es obligatorio',
         'name.min' => 'El nombre ha de tener al menos 3 caracteres',
         'description.required' => 'La descripción es obligatoria',
         'description.max' => 'La descripción no puede tener más de 200 caracteres',
         'price.required' => 'El precio es obligatorio',
         'price.numeric' => 'El precio debe ser un número',
         'price.min' => 'El precio mínimo es cero'
      ];
   }
}
