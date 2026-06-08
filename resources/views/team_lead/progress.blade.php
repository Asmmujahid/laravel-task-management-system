@extends('layout.app')

@section('content')
<div class="content-container">
    <h2>Team Progress</h2>

    <div class="progress-cards">
        @foreach($teamMembers as $member)
        <div class="card">
            <h4>{{ $member->name }}</h4>
            <p>Completed Tasks: {{ $member->completedTasks }}</p>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: {{ $member->progress }}%;" aria-valuenow="{{ $member->progress }}" aria-valuemin="0" aria-valuemax="100">
                    {{ $member->progress }}%
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
