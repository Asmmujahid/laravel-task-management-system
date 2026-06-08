@extends('layout.app')

@section('content')

<div class="content-container">

    <h2>Edit Task</h2>

    {{-- SUCCESS --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    <form action="{{ route('team_lead.tasks.update', $task->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        {{-- STATUS --}}
        <div class="form-group mb-3">

            <label>
                <strong>Status</strong>
            </label>

            <select name="status" class="form-control">

                <option value="pending"
                    {{ $task->status == 'pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="in_progress"
                    {{ $task->status == 'in_progress' ? 'selected' : '' }}>
                    In Progress
                </option>

                <option value="completed"
                    {{ $task->status == 'completed' ? 'selected' : '' }}>
                    Completed
                </option>

            </select>

            @error('status')

                <span class="text-danger">
                    {{ $message }}
                </span>

            @enderror

        </div>

        {{-- TEAM --}}
        <div class="form-group mb-3">

            <label>
                <strong>Select Team</strong>
            </label>

            <select name="team_id"
                    id="teamSelect"
                    class="form-control">

                <option value="">
                    Select Team
                </option>

                @foreach($teams as $team)

                    <option value="{{ $team->id }}"
                        {{ $task->team_id == $team->id ? 'selected' : '' }}>

                        {{ $team->name }}

                    </option>

                @endforeach

            </select>

            @error('team_id')

                <span class="text-danger">
                    {{ $message }}
                </span>

            @enderror

        </div>

        {{-- TEAM MEMBER --}}
        <div class="form-group mb-3">

            <label>
                <strong>Assign To</strong>
            </label>

            <select name="assigned_to"
                    id="memberSelect"
                    class="form-control">

                <option value="">
                    Select Team Member
                </option>

            </select>

            @error('assigned_to')

                <span class="text-danger">
                    {{ $message }}
                </span>

            @enderror

        </div>

        {{-- BUTTON --}}
        <button type="submit"
                class="btn btn-success">

            Update Task

        </button>

        <a href="{{ route('team_lead.tasks.index') }}"
           class="btn btn-secondary">

            Back

        </a>

    </form>

</div>

{{-- SCRIPT --}}
<script>

    // ALL TEAMS WITH MEMBERS
    const teams = @json($teams);

    // CURRENT TASK MEMBER
    const currentAssignedUser = "{{ $task->assigned_to }}";

    const teamSelect = document.getElementById('teamSelect');

    const memberSelect = document.getElementById('memberSelect');

    // LOAD MEMBERS
    function loadMembers(teamId)
    {
        memberSelect.innerHTML =
            '<option value="">Select Team Member</option>';

        const selectedTeam = teams.find(
            team => team.id == teamId
        );

        if (selectedTeam)
        {
            selectedTeam.members.forEach(member => {

                let selected = member.id == currentAssignedUser
                    ? 'selected'
                    : '';

                memberSelect.innerHTML += `
                    <option value="${member.id}" ${selected}>
                        ${member.name}
                    </option>
                `;
            });
        }
    }

    // ON TEAM CHANGE
    teamSelect.addEventListener('change', function () {

        loadMembers(this.value);

    });

    // INITIAL LOAD
    window.onload = function () {

        loadMembers(teamSelect.value);

    };

</script>

@endsection