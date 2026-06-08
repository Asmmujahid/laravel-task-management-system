@extends('layout.app')

@section('content')
<div class="container">

    <h2>My Teams</h2>

    <a href="{{ route('team_lead.teams.create') }}" class="btn btn-primary mb-3">
        + Add Team
    </a>

    @foreach($teams as $team)
        <div class="card mb-4 p-3">

            <h4>{{ $team->name }}</h4>
            <p><strong>Category:</strong> {{ optional($team->category)->name ?? 'No Category' }}</p>
<div class="action-buttons">

    <a href="{{ route('team_lead.teams.edit', $team->id) }}"
       class="btn btn-warning btn-sm action-btn">
        Edit
    </a>

    <form action="{{ route('team_lead.teams.destroy', $team->id) }}"
          method="POST">
        @csrf
        @method('DELETE')

        <button type="submit"
                class="btn btn-danger btn-sm action-btn">
            Delete
        </button>
    </form>

</div>
            <hr>

            <div style="display:flex; flex-wrap:wrap; gap:10px;">
                @foreach($team->members as $member)
                    <div style="background:#eee;padding:6px 10px;border-radius:20px;display:flex;align-items:center;gap:5px;">
                        {{ $member->name }}

                        <form method="POST" action="{{ route('team_lead.teams.removeMember', $member->id) }}">
                            @csrf
                            @method('DELETE')

                            <button style="background:red;color:white;border:none;border-radius:50%;width:20px;height:20px;cursor:pointer;">
                                ×
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

        </div>
    @endforeach

</div>
@endsection