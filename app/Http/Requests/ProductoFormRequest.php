<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoFormRequest extends FormRequest
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
          'ID_UnidadMedida'=>'required',
          'Nombre'=>'required',
          'Descripcion'=>'',
          'ID_Categoria'=>'required',
          'ID_Fabricante'=>'required',
          'ID_UnidadMedida'=>'required',
          'Stock'=>'required|numeric',
          'Estado'=>'required|numeric',
          'StockMinimo'=>'required|numeric',
          'Precio1'=>'required|numeric',
          'Precio2'=>'numeric',
          'Precio3'=>'numeric',
          'PrecioRefCompra'=>'numeric',

      ];
    }
}
