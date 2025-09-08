<?php

namespace Modules\DesaModuleRelease\Helpers;

class ModuleMeta
{
    public static function get(string $key): ?string
    {
        $meta = [
            'label' => 'Desa Module Release',
            'studly' => 'DesaModuleRelease',
            'kebab' => 'desa-module-release',
            'snake' => 'desa_module_release',
            'plain' => 'desamodulerelease',
            'constant' => 'DESA_MODULE_RELEASE',
        ];

        return $meta[$key] ?? null;
    }
}
