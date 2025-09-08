<?php

namespace Modules\DesaModuleRelease\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmablePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'password' => 'required',
        ];
    }
}
