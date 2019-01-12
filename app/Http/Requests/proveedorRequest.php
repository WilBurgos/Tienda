<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class proveedorRequest extends FormRequest
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
            'compania'  => 'required',
            'direccion' => 'required',
            'telefono'  => 'required',
            'correo'    => 'required'
        ];
    }
    public function attributes()
    {
        return [
          'compania'    => 'compañía',
          'direccion'   => 'dirección',
          'telefono'    => 'teléfono',
          'correo'      => 'correo'
        ];
    }

}
