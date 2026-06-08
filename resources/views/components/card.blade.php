@props([
    'title' => '',
    'icon' => '',
    'value' => '',
    'color' => 'primary',
])

<div class="dashboard-card">

    <div class="card-top">

        <div>

            <p class="card-title">

                {{ $title }}

            </p>

            <h3 class="card-value">

                {{ $value }}

            </h3>

        </div>

        <div class="card-icon bg-{{ $color }}">

            <i class="{{ $icon }}"></i>

        </div>

    </div>

    {{ $slot }}

</div>