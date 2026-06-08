{{-- resources/views/team_member/comment_file.blade.php --}}

@extends('layout.app')

@section('content')

<div class="content-container">

<div class="card shadow border-0 mb-4">

<div class="card-header bg-primary text-white">
<h4 class="mb-0">Add File / Comment</h4>
</div>

<div class="card-body">

@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<form action="{{ route('team_member.comments.files.store') }}"
method="POST"
enctype="multipart/form-data">

@csrf

<div class="mb-3">
<label>Select Task</label>

<select name="task_id" class="form-control" required>
<option value="">Choose Task</option>

@foreach($tasks as $task)
<option value="{{ $task->id }}">
{{ $task->title }}
</option>
@endforeach

</select>
</div>


<div class="mb-3">
<label>Select Category</label>
<select name="category_id" class="form-control" required>
<option value="">Choose Category</option>

@foreach($categories as $cat)
<option value="{{ $cat->id }}">
{{ $cat->name }}
</option>
@endforeach

</select>
</div>

<div class="mb-3">
<label>Write Comment</label>

<textarea name="comment"
class="form-control"
rows="4"
required></textarea>
</div>

<div class="mb-3">
<label>Upload File</label>

<input type="file"
name="files[]"
multiple
class="form-control">
</div>

<button class="btn btn-success">
Submit Task Work
</button>

</form>

</div>
</div>



<div class="card shadow border-0">

<div class="card-header bg-dark text-white">
<h4 class="mb-0">Submitted Work</h4>
</div>

<div class="card-body">

<table class="table table-bordered">

<thead class="table-dark">
<tr>
<th>#</th>
<th>Task</th>
<th>Category</th>
<th>Comment</th>
<th>File</th>
<th>Action</th>
<th>Status</th>
<th>Review</th>
</tr>
</thead>

<tbody>

@forelse($records as $item)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $item->task->title ?? '-' }}</td>
<td>{{ $item->category->name ?? '-' }}</td>

<td>{{ $item->comment }}</td>

<td>

@foreach($item->task->files->where('user_id',auth()->id()) as $file)

<a href="{{ asset('uploads/tasks/'.$file->file_path) }}"
target="_blank"
class="btn btn-sm btn-primary mb-1">
View File
</a>

@endforeach

</td>

<td>

<a href="{{ route('team_member.comments.edit',$item->id) }}"
class="btn btn-warning btn-sm">
Edit
</a>

<form action="{{ route('team_member.comments.delete',$item->id) }}"
method="POST"
class="d-inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm">
Delete
</button>

</form>

</td>

<td>

{{-- STATUS FROM ADMIN --}}
@if($item->status == 'approved')
    <span class="badge bg-success">Approved</span>
@elseif($item->status == 'rejected')
    <span class="badge bg-danger">Rejected</span>
@elseif($item->status == 'correction')
    <span class="badge bg-warning text-dark">Need Correction</span>
@else
    <span class="badge bg-secondary">-</span>
@endif

</td>

<td>

<td>
@if(!empty($item->review))
    <div class="alert alert-success p-2 m-0">
        {{ $item->review }}
    </div>
@else
    <span class="text-muted">
        Pending Review
    </span>
@endif
</td>

</tr>

@empty

<tr>
<td colspan="6" class="text-center text-danger">
No Submitted Work
</td>
</tr>

@endforelse

</tbody>

</table>

</div>
</div>

</div>

@endsection