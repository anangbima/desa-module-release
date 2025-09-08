<?php

namespace Modules\DesaModuleRelease\Http\Requests\Web\Auth;

use Illuminate\Foundation\Http\FormRequest;

class OtpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'otp' => ['required', 'digits:6']
        ];
    }
}
