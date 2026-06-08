@extends('layout.app')

@section('content')
<div class="container">
    <h2>Create Team</h2>

    <form method="POST" action="{{ route('team_lead.teams.store') }}">
        @csrf

        <input type="text" name="name" class="form-control mb-2" placeholder="Team Name">

        <select name="category_id" class="form-control mb-2">
            <option value="">Select Category</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>

        @foreach($users as $user)
            <div>
                <input type="checkbox" name="members[]" value="{{ $user->id }}">
                {{ $user->name }}
            </div>
        @endforeach

        <button class="btn btn-primary mt-2">Create</button>
    </form>
</div>
@endsection