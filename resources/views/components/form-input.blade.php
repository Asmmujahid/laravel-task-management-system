@props([
    'label' => '',
    'name',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
])

<div class="form-group">

    <label>

        {{ $label }}

    </label>

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        class="form-control @error($name) is-invalid @enderror"
    >

    @error($name)

        <small class="text-danger">

            {{ $message }}

        </small>

    @enderror

</div>