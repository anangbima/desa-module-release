<x-desa-module-release::admin-layout
    :title="__($title)"
    :role="'Admin'"
    :module="__(desa_module_release_meta('label'))"
    :desa="config('app.name')"
    :breadcrumbs="$breadcrumbs"
>

    <form action="{{ route(desa_module_release_meta('kebab').'.admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        @php
            $grouped = $settings->groupBy('group');
        @endphp

        @foreach ($grouped as $groupName => $groupSettings)
            {{-- Section per group --}}
            <div class="mb-8">
                <div class="pb-4 border-b border-gray-200 dark:border-gray-700">
                    <h1 class="text-lg font-bold text-gray-700 dark:text-gray-200">
                        {{ ucfirst($groupName) }}
                    </h1>
                    <div class="text-xs text-gray-600 mt-1">
                        {{ $descriptions[$groupName] ?? 'Pengaturan untuk ' . ucfirst($groupName) }}
                    </div>
                </div>

                {{-- Loop setting di dalam group --}}
                <div class="space-y-4 px-8 py-6">
                    @foreach ($groupSettings as $setting)
                        @php
                            $inputType = match($setting->type) {
                                'boolean' => 'checkbox',
                                'integer' => 'number',
                                default => 'text',
                            };
                        @endphp

                        @if ($setting->type === 'boolean')
                            <div class="flex items-center gap-2">
                                <input type="checkbox"
                                       id="{{ $setting->key }}"
                                       name="{{ $setting->key }}"
                                       value="1"
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                                       {{ $setting->value ? 'checked' : '' }}>
                                <label for="{{ $setting->key }}" class="text-sm text-gray-700 dark:text-gray-300">
                                    {{ ucfirst(str_replace('_',' ', $setting->key)) }}
                                </label>
                            </div>
                        @else
                            <div>
                                <label for="{{ $setting->key }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ ucfirst(str_replace('_',' ', $setting->key)) }}
                                </label>
                                <input type="{{ $inputType }}"
                                       id="{{ $setting->key }}"
                                       name="{{ $setting->key }}"
                                       value="{{ old($setting->key, $setting->value) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                       {{ $setting->type === 'integer' ? 'min=0' : '' }}>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach

        {{-- Action buttons --}}
        <div class="mt-8 flex justify-end gap-2">
            <x-link :intent="'ghost'" href="{{ route(desa_module_release_meta('kebab').'.admin.settings.index') }}">
                Cancel
            </x-link>
             <x-link :intent="'primary'" href="{{ route(desa_module_release_meta('kebab').'.admin.settings.index') }}">
                Cancel
            </x-link>
        </div>
    </form>

</x-desa-module-release::admin-layout>
