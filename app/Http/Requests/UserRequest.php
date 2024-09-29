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
            'password' => 'required|string|min:8',
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
        if ($this->isMethod('post')) {
            // Reglas para la creación
            $rules['password'] = 'required|string|min:8|confirmed';
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            // Reglas para la edición
            $rules['password'] = 'nullable|string|min:8|confirmed';
        }
        return $rules;

    }
}
