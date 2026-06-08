@extends('layout.app')

@section('content')
<div class="container">

    <h3>Manage Team Roles</h3>

    <form method="POST" action="{{ route('team_lead.teams.update') }}">
        @csrf
        @method('PUT')

        @foreach($teamMembers as $member)
            <div class="mb-3">
                <label>{{ $member->name }}</label>

                <select name="roles[{{ $member->id }}]" class="form-control">

                    <option value="team_member"
                        {{ $member->role == 'team_member' ? 'selected' : '' }}>
                        Team Member
                    </option>

                    <option value="team_lead"
                        {{ $member->role == 'team_lead' ? 'selected' : '' }}>
                        Team Lead
                    </option>

                </select>
            </div>
        @endforeach

        <button class="btn btn-success">Update Roles</button>
    </form>

</div>
@endsection