@extends('layout.app')

@section('content')

<div class="content-container">

    <h2>Settings</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}"
          method="POST">

        @csrf

        @foreach($settings as $setting)

        <div class="mb-3">

            <label class="form-label">
                {{ ucfirst(str_replace('_',' ', $setting->key)) }}
            </label>

            <input type="text"
                   name="settings[{{ $setting->key }}]"
                   value="{{ $setting->value }}"
                   class="form-control">

        </div>

        @endforeach

        <button type="submit" class="btn btn-success">
            Update Settings
        </button>

    </form>

</div>

@endsection