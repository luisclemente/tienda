<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockRequest extends FormRequest
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
