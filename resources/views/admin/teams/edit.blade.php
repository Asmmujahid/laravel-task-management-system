@extends('layout.app')

@section('content')
<div class="container">
    <h2>Edit Team</h2>

    <form action="{{ route('admin.teams.update', $team->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Team Name -->
        <div class="mb-3">
            <label>Team Name</label>
            <input type="text" name="name"
                   value="{{ $team->name }}"
                   class="form-control">
        </div>

        <!-- Team Lead -->
        <div class="mb-3">
            <label>Team Lead</label>
            <select name="lead_id" class="form-control">
                @foreach($leads as $lead)
                    <option value="{{ $lead->id }}"
                        {{ $team->lead_id == $lead->id ? 'selected' : '' }}>
                        {{ $lead->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Category -->
        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ $team->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Members -->
        <div class="mb-3">
            <label>Members</label>

            @foreach($members as $member)
                <div>
                    <input type="checkbox"
                           name="members[]"
                           value="{{ $member->id }}"
                           {{ $member->team_id == $team->id ? 'checked' : '' }}>
                    {{ $member->name }}
                </div>
            @endforeach
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('admin.teams.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection