@extends('layout.app')

@section('content')

<div class="content-container">

<div class="card shadow">

<div class="card-header bg-warning">
<h4>Edit Submission</h4>
</div>

<div class="card-body">

<form action="{{ route('admin.task.submissions.update', $submission->id) }}"
method="POST">

@csrf
@method('PUT')

<div class="mb-3">
<label>Task</label>
<input type="text"
value="{{ $submission->task->title }}"
class="form-control"
readonly>
</div>

<div class="mb-3">
<label>Category</label>
<input type="text"
value="{{ $submission->category->name ?? '-' }}"
class="form-control"
readonly>
</div>

<div class="mb-3">
<label>Team Lead</label>
<input type="text"
value="{{ $submission->task->team->lead->name ?? '-' }}"
class="form-control"
readonly>
</div>

<div class="mb-3">
<label>Comment</label>

<textarea name="comment"
rows="5"
class="form-control"
required>{{ $submission->comment }}</textarea>

</div>

<button class="btn btn-success">
Update
</button>

<a href="{{ route('admin.task.submissions') }}"
class="btn btn-secondary">
Back
</a>

</form>

</div>
</div>

</div>

@endsection