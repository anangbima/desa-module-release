<x-desa-module-release::admin-layout
    :title="__($title)"
    :role="'Admin'"
    :module="__(desa_module_release_meta('label'))"
    :desa="config('app.name')"
    :breadcrumbs="$breadcrumbs"
>
    {{-- Table Section --}}
    <x-desa-module-release::log-activity-table 
        :logs="$logs"
    />

</x-desa-module-release::admin-layout>