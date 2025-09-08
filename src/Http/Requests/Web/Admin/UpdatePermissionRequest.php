<?php

namespace Modules\DesaModuleRelease\Http\Requests\Web\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:desa_module_release.desa_module_release_permissions,name,' . $this->route('permission')->id,
            ],
            'module_name' => [
                'string',
            ],
        ];
    }
}
