{{-- resources/views/team_lead/submissions/index.blade.php --}}

@extends('layout.app')

@section('content')

<div class="content-container">

<h2 class="mb-4">Task Submissions</h2>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<div class="table-responsive">

<table class="table table-bordered table-striped">

<thead class="table-dark">
<tr>
    <th>#</th>
    <th>Task</th>
    <th>Category</th>
    <th>Member</th>
    <th>Comment</th>
    <th>File</th>
    <th>Status</th>
    <th width="220">Review</th>
    <th width="180">Action</th>
</tr>
</thead>

<tbody>

@forelse($submissions as $item)

<tr>

    <td>{{ $loop->iteration }}</td>

    <td>{{ $item->task->title ?? '-' }}</td>

    <td>{{ $item->category->name ?? '-' }}</td>

   <td>{{ $item->task->assignedUser->name ?? '-' }}</td>

    <td>{{ $item->comment }}</td>

    <td>
        @forelse($item->task->files->where('user_id', $item->user_id) as $file)

            <a href="{{ asset('uploads/tasks/'.$file->file_path) }}"
               target="_blank"
               class="btn btn-sm btn-primary mb-1">
               View File
            </a>
            <br>

        @empty
            <span class="text-muted">No File</span>
        @endforelse
    </td>

    <td>

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

        {{-- REVIEW FORM --}}
        <form action="{{ route('team_lead.submissions.review', $item->id) }}"
              method="POST">

            @csrf

            <textarea name="review"
                      rows="2"
                      class="form-control mb-2"
                      placeholder="Write review...">{{ $item->review }}</textarea>

            <button type="submit"
                    class="btn btn-success btn-sm w-100">
                Save Review
            </button>

        </form>

    </td>

    

    <td>

        <div class="d-flex gap-1 flex-wrap">

            {{-- EDIT --}}
            <a href="{{ route('team_lead.submissions.edit', $item->id) }}"
               class="btn btn-warning btn-sm"
               title="Edit">
               ✏️
            </a>

            {{-- DELETE --}}
            <form action="{{ route('team_lead.submissions.delete', $item->id) }}"
                  method="POST"
                  onsubmit="return confirm('Delete Submission?')">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="btn btn-danger btn-sm"
                        title="Delete">
                    🗑️
                </button>

            </form>

            {{-- FINAL SUBMIT TO ADMIN --}}
          <form action="{{ route('team_lead.submissions.final.submit', $item->id) }}"
      method="POST">

    @csrf

    <button type="submit"
            class="btn btn-dark btn-sm">

        Submit

    </button>

</form>

        </div>

    </td>

</tr>

@empty

<tr>
    <td colspan="8" class="text-center text-danger">
        No Submission Found
    </td>
</tr>

@endforelse

</tbody>

</table>

</div>

</div>

@endsection