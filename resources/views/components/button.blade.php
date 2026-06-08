@props([
    'type' => 'primary',
    'href' => null,
])

@if($href)

<a href="{{ $href }}"
   {{ $attributes->merge(['class' => 'btn btn-'.$type]) }}>

    {{ $slot }}

</a>

@else

<button {{ $attributes->merge(['class' => 'btn btn-'.$type]) }}>

    {{ $slot }}

</button>

@endif