@extends('layout.app')

@section('content')
<div class="container">
    <h2>Edit Team</h2>

    <form method="POST" action="{{ route('team_lead.teams.update', $team->id) }}">
        @csrf
        @method('PUT')

        <input type="text" name="name"
               value="{{ $team->name }}"
               class="form-control mb-2">

        <select name="category_id" class="form-control mb-2">
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                    {{ $team->category_id == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        @foreach($users as $user)
            <div>
                <input type="checkbox" name="members[]" value="{{ $user->id }}"
                    {{ $user->team_id == $team->id ? 'checked' : '' }}>
                {{ $user->name }}
            </div>
        @endforeach

        <button class="btn btn-success mt-2">Update</button>
    </form>
</div>
@endsection