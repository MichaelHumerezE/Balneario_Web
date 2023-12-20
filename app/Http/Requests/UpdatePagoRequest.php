<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePagoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'monto_total' => '',
            'fecha_hora' => 'required',
            'estado' => 'required',
            'tipo' => 'required',
            'nota_venta_id' => 'required',
            'imagen' => '',
            'url' => '',
            'pago_facil_id' => '',
        ];
    }
}
