<?php

namespace Modules\DesaModuleRelease\Http\Requests\Web\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'string', 'unique:desa_module_release.users,email,' . $this->route('user')->slug. ',slug'],
            'role' => ['required', 'string', 'exists:desa_module_release.desa_module_release_roles,id'],
            'province' => ['required', 'string'],
            'city' => ['required', 'string'],
            'district' => ['required', 'string'],
            'village' => ['required', 'string'],
        ];
    }
}
