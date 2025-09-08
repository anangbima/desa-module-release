<x-desa-module-template::admin-layout
    :title="__($title)"
    :role="'Admin'"
    :module="__(desa_module_template_meta('label'))"
    :desa="config('app.name')"
>

<h1>Edit User Status</h1>

<form action="{{ route(desa_module_template_meta('kebab').'.admin.users.status.update', $user->slug) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="status">Status</label>
        <select id="status" name="status">
            <option value="1" {{ $user->status ? 'selected' : '' }}>Active</option>
            <option value="0" {{ !$user->status ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>
    <button type="submit">Update Status</button>
    <a href="{{ route(desa_module_template_meta('kebab').'.admin.users.index') }}">Cancel</a>
</form>

</x-desa-module-template::admin-layout>