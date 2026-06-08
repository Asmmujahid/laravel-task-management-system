@props([
    'type' => 'success',
    'message' => '',
])

@php

    $class = match($type) {

        'success' => 'alert-success',
        'danger'  => 'alert-danger',
        'warning' => 'alert-warning',
        'info'    => 'alert-info',

        default   => 'alert-primary',
    };

@endphp

@if($message)

<div class="custom-alert {{ $class }}">

    <div class="alert-content">

        @if($type == 'success')
            <i class="fa-solid fa-circle-check"></i>
        @elseif($type == 'danger')
            <i class="fa-solid fa-circle-xmark"></i>
        @elseif($type == 'warning')
            <i class="fa-solid fa-triangle-exclamation"></i>
        @else
            <i class="fa-solid fa-circle-info"></i>
        @endif

        <span>{{ $message }}</span>

    </div>

</div>

@endif