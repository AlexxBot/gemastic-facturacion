<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NegocioFormRequest extends FormRequest
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
            'Ruc'=>'required|min:11|max:11|unique:negocios',
            'RazonSocial'=>'required|min:6',
            'Denominacion'=>'alpha_dash',
            'Direccion'=>'required|alpha_dash',
            'Telefono1'=>'integer',
            'Telefono2'=>'integer',
            'Email'=>'required|email',
            'Web'=>'url',
            'RepLegal'=>'alpha_dash',
            'Ubigeo'=>'integer|min:6|max:6'
        ];
    }
}
