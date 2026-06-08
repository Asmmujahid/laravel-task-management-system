@extends('layout.app')

@section('content')
<div class="content-container">

    <h2>Assign Task to Team</h2>

    {{-- TASK INFO --}}
    <div class="card p-3 mb-3">
        <h4>{{ $task->title }}</h4>
        <p>{{ $task->description }}</p>

        <p>
            <strong>Category:</strong> {{ $task->category->name ?? '-' }}
        </p>

        <p>
            <strong>Due Date:</strong> 
            {{ $task->due_date ? $task->due_date->format('d M Y') : '-' }}
        </p>
    </div>

    {{-- FORM --}}
    <form action="{{ route('team_lead.tasks.assign', $task->id) }}" method="POST">
        @csrf

        {{-- TEAM SELECT --}}
        <div class="form-group mb-3">
            <label><strong>Select Team</strong></label>

            <select name="team_id" id="teamSelect" class="form-control">
                <option value="">-- Select Team --</option>

                @foreach($teams as $team)
                    <option value="{{ $team->id }}">
                        {{ $team->name }}
                    </option>
                @endforeach
            </select>

            @error('team_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- TEAM MEMBERS PREVIEW --}}
        <div class="form-group mb-3">
            <label><strong>Team Members (Auto Assign)</strong></label>

            <div id="teamMembersBox" style="background:#f8f9fa;padding:10px;border-radius:6px;">
                <p class="text-muted">Select a team to view members</p>
            </div>
        </div>

        {{-- INFO --}}
        <div class="alert alert-info">
            ⚡ This task will be automatically assigned to ALL selected team members.
        </div>

        {{-- SUBMIT --}}
        <button class="btn btn-success">
            Assign Task
        </button>
    </form>

</div>

{{-- SCRIPT --}}
<script>
    const teams = @json($teams);

    document.getElementById('teamSelect').addEventListener('change', function () {

        const teamId = this.value;
        const box = document.getElementById('teamMembersBox');

        box.innerHTML = '';

        if (!teamId) {
            box.innerHTML = '<p class="text-muted">Select a team to view members</p>';
            return;
        }

        const selectedTeam = teams.find(t => t.id == teamId);

        if (selectedTeam && selectedTeam.members.length > 0) {

            selectedTeam.members.forEach(member => {
                box.innerHTML += `
                    <span style="
                        display:inline-block;
                        background:#007bff;
                        color:white;
                        padding:5px 10px;
                        margin:5px;
                        border-radius:20px;
                    ">
                        ${member.name}
                    </span>
                `;
            });

        } else {
            box.innerHTML = '<p class="text-danger">No members in this team</p>';
        }
    });
</script>

@endsection