<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|in:activo,pausado,finalizado',
        ];
    }
}