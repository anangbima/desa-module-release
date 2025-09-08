<x-desa-module-template::admin-layout
    :title="__($title)"
    :role="'Admin'"
    :module="__(desa_module_template_meta('label'))"
    :desa="config('app.name')"
    :breadcrumbs="$breadcrumbs"
>
    {{-- Description --}}
    <div class="text-sm p-4 bg-gray-100 rounded-lg text-gray-600 dark:text-gray-400 mb-6">
        Log Activities record all important actions within the system, 
        including which user performed them, when they occurred, and a brief description of the activity. 
        This information helps to monitor system usage and conduct audits when necessary. 
        <span><a class="text-blue-500 hover:text-blue-700" href="#">Learn more</a></span>
    </div>

    {{-- Button Export --}}
    <div class="mb-2 flex justify-end">
        <div>
            <x-link 
                size="sm" 
                class="rounded-lg"
                intent="secondary"
                href="#"
                @click="$dispatch('open-modal', { name: 'modal-export' })"
            >
                <x-slot:iconBefore>
                    <span class="icon-[solar--export-outline] text-lg"></span>
                </x-slot:iconBefore>
                Export
            </x-link>
        </div>
    </div>

    {{-- Table Section --}}
    <div class="">
        <x-table-default
            title="Log Activity"
            :headers="[
                'User',
                'Action',
                'Description',
                'Logged At',
            ]"
        >
            @foreach($logs as $log)
                <tr class="h-18">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div class="flex items-center gap-5">
                            <img
                                src="{{ $log->user->profile_image_url ?? asset('assets/default-profile.jpg') }}"
                                alt="{{ $log->user->name }}"
                                class="w-10 h-10 rounded-full object-cover ring-1 ring-gray-200 dark:ring-gray-800"
                            >
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    {{ $log->user->name }}
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $log->user->email }}
                                </span>
                            </div>
                        </div>
                    </td>
                    <td>
                        @php
                            $color = desa_module_template_action_color($log->action);
                        @endphp

                        <x-badge 
                            text="{{ desa_module_template_format_action($log->action) }}" 
                            size="sm" 
                            color="{{ $color }}"  />
                    </td>
                    <td class="max-w-xs truncate" title="{{ $log->description }}">
                        {{ $log->description }}
                    </td>
                    <td>{{ $log->logged_at->diffForHumans() }}</td>
                    <td x-data="{ isOpen: false }" class="relative">
                        <!-- Trigger button -->
                        <div 
                            class="flex items-center justify-center cursor-pointer" 
                            @click="isOpen = !isOpen"
                        >
                            <span class="text-2xl icon-[pepicons-pencil--dots-y]"></span>
                        </div>

                        <!-- Dropdown -->
                        <div 
                            x-show="isOpen" 
                            @click.away="isOpen = false" 
                            x-transition:enter="transition ease-out duration-200" 
                            x-transition:enter-start="opacity-0 scale-95" 
                            x-transition:enter-end="opacity-100 scale-100" 
                            x-transition:leave="transition ease-in duration-150" 
                            x-transition:leave-start="opacity-100 scale-100" 
                            x-transition:leave-end="opacity-0 scale-95" 
                            class="absolute right-2 z-50 mt-2 w-48 origin-top-right rounded-lg bg-white dark:bg-gray-900/30 backdrop-blur-xl shadow-xl ring-1 ring-gray-900/5 overflow-hidden"
                             x-cloak
                        >
                            <div class="p-2">
                                <a 
                                    href="{{ route(desa_module_template_meta('kebab').'.admin.logs.show', $log->id) }}"
                                    class="flex items-center w-full px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded"
                                >
                                    <span class="icon-[proicons--eye] size-5"></span>
                                    <span class="ml-2 text-xs font-medium">View</span>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-table-default>
    </div>

    {{-- Export Modal --}}
    <x-modal 
        name="modal-export" 
        title="Export Data Log" 
        maxWidth="xl"
    >
        <div class="pb-4 space-y-4">

            <p class="text-sm text-gray-600 dark:text-gray-400">
                Pilih format file yang ingin digunakan untuk mengekspor data pengguna. 
            </p>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                <a 
                    href="{{ route(desa_module_template_meta('kebab').'.admin.logs.export', ['type' => 'xlsx']) }}" 
                    class="bg-white dark:bg-slate-900 flex items-center justify-center border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                >
                    <span class="icon-[mdi--microsoft-excel] text-green-600 mr-2"></span>
                    XLSX
                </a>

                <a 
                    href="{{ route(desa_module_template_meta('kebab').'.admin.logs.export', ['type' => 'csv']) }}" 
                    class="bg-white dark:bg-slate-900 flex items-center justify-center border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                >
                    <span class="icon-[mdi--file-delimited] text-blue-600 mr-2"></span>
                    CSV
                </a>

                <a 
                    href="{{ route(desa_module_template_meta('kebab').'.admin.logs.export', ['type' => 'pdf']) }}" 
                    class="bg-white dark:bg-slate-900 flex items-center justify-center border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                >
                    <span class="icon-[mdi--file-pdf-box] text-red-600 mr-2"></span>
                    PDF
                </a>

                <a 
                    href="{{ route(desa_module_template_meta('kebab').'.admin.logs.export', ['type' => 'docx']) }}" 
                    class="bg-white dark:bg-slate-900 flex items-center justify-center border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                >
                    <span class="icon-[mdi--microsoft-word] text-blue-700 mr-2"></span>
                    DOCX
                </a>

                <a 
                    href="{{ route(desa_module_template_meta('kebab').'.admin.logs.export', ['type' => 'json']) }}" 
                    class="bg-white dark:bg-slate-900 flex items-center justify-center border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                >
                    <span class="icon-[mdi--code-json] text-yellow-600 mr-2"></span>
                    JSON
                </a>
            </div>
        </div>

        <x-slot name="footer">
            <button @click="$dispatch('close-modal')" class="rounded-md bg-gray-200 px-3 py-1 text-gray-700 text-sm hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 transition cursor-pointer">
                Close
            </button>
        </x-slot>
    </x-modal>

</x-desa-module-template::admin-layout>