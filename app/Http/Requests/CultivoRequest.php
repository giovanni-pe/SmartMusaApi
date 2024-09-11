<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CultivoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'nombre' => 'required|string',
			'descripcion' => 'string',
			'limite_max_humedad_soportada' => 'required',
			'limite_min_humedad_soportada' => 'required',
			'limite_max_temperatura_soportada' => 'required',
			'limite_min_temperatura_soportada' => 'required',
			'estado' => 'required',
			'vivero_id' => 'required',
        ];
    }
}
