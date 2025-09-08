<x-desa-module-template::admin-layout
    :title="__($title)"
    :role="'Admin'"
    :module="__(desa_module_template_meta('label'))"
    :desa="config('app.name')"
>

<h1>Settings</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<br>
@if(session('success'))
    <div class="alert alert-success mb-4">
        {{ session('success') }}
    </div>
@endif
<br>

<form action="{{ route(desa_module_template_meta('kebab').'.admin.settings.update') }}" method="POST">
    @csrf
    @method('PUT')
    
    @foreach ($settings as $setting)

        <div class="mb-3">
            <label for="{{ $setting->key }}" class="form-label">{{ $setting->key }}</label>
        </div>

        @php
            $inputType = match($setting->type) {
                'boolean' => 'checkbox',
                'integer' => 'number',
                default => 'text',
            };
        @endphp

        @if ($setting->type === 'boolean')
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="{{ $setting->key }}" name="{{ $setting->key }}" value="1" {{ $setting->value ? 'checked' : '' }}>
                <label class="form-check-label" for="{{ $setting->key }}">{{ $setting->key }}</label>
            </div>
        @else
            <input type="{{ $inputType }}" class="form-control" id="{{ $setting->key }}" name="{{ $setting->key }}" value="{{ old($setting->key, $setting->value) }}" {{ $setting->type === 'integer' ? 'min=0' : '' }}>    
        @endif

        <br>
        <br>

    @endforeach

    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Save Settings</button>
        <a href="{{ route(desa_module_template_meta('kebab').'.admin.settings.index') }}" class="btn btn-secondary">Cancel</a>
    </div>

</form>

</x-desa-module-template::admin-layout>