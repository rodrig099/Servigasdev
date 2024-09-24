<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
			'name' => 'required|string',
			'email' => 'required|string',
			'two_factor_secret' => 'string',
			'two_factor_recovery_codes' => 'string',
			'profile_photo_path' => 'string',
			'apellidos' => 'string',
			'direccion' => 'string',
			'telefono' => 'string',
			'barrio' => 'string',
			'ciudad' => 'string',
			'departamento' => 'string',
			'cedula' => 'string',
        ];
    }
}
