<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
   public function authorize ()
   {
      return true;
   }

   public function rules ()
   {
      return [
         'name' => 'required|min:3',
         'description' => 'max:200'
      ];
   }

   public function messages ()
   {
      return [
         'name.required' => 'El nombre es obligatorio',
         'name.min' => 'El nombre ha de tener al menos 3 caracteres',
         'description.max' => 'La descripción no puede tener más de 200 caracteres'
      ];
   }
}
