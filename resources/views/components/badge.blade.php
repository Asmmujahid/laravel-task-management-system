@props([
    'type' => 'primary',
    'text' => '',
])

<span class="custom-badge badge-{{ $type }}">

    {{ $text }}

</span>