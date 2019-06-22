<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
           'stock' => 'required | numeric | min:0'
        ];
    }

   public function messages()
   {
      return [
         'stock.required' => 'El stock es obligatorio',
         'stock.numeric' => 'El stock- debe ser un número no negativo',
         'stock.min' => 'El stock mínimo es cero',
      ];
   }
}
