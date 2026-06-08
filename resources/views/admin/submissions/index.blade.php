@extends('layout.app')

@section('content')

<div class="content-container">

    <h2>Submitted Tasks By Team Lead</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">

       <table class="table table-bordered table-striped align-middle">

            <thead class="table-dark">
                <tr>
                    <th width="60">#</th>
                    <th>Task</th>
                    <th>Category</th>
                    <th>Team Lead</th>
                    <th>Comment</th>
                    <th>File</th>
                    <th>Status</th>
                    <th width="180">Update Status</th>
                    <th width="120">Manage</th>
                </tr>
            </thead>

            <tbody>

                @forelse($submissions as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ $item->task->title ?? '-' }}
                        </td>

                        <td>
                            {{ $item->category->name ?? '-' }}
                        </td>

                        <td>
                            {{ $item->task->team->lead->name ?? '-' }}
                        </td>

                        <td>
                            {{ $item->comment }}
                        </td>

                        <td>

                            @forelse($item->task->files->where('user_id',$item->user_id) as $file)

                                <a href="{{ asset('uploads/tasks/'.$file->file_path) }}"
                                   target="_blank"
                                   class="btn btn-primary btn-sm mb-1">

                                    View File

                                </a>

                            @empty

                                <span class="text-muted">
                                    No File
                                </span>

                            @endforelse

                        </td>

                        <td>

                            @if($item->status == 'approved')

                                <span class="badge bg-success">
                                    Approved
                                </span>

                            @elseif($item->status == 'rejected')

                                <span class="badge bg-danger">
                                    Rejected
                                </span>

                            @elseif($item->status == 'correction')

                                <span class="badge bg-warning text-dark">
                                    Correction
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    Pending
                                </span>

                            @endif

                        </td>

                        <td>

                            <form action="{{ route('admin.task.submissions.status', $item->id) }}"
                                  method="POST">

                                @csrf

                                <select name="status"
                                        class="form-control mb-2"
                                        required>

                                    <option value="">
                                        Select Status
                                    </option>

                                    <option value="approved">
                                        Approve
                                    </option>

                                    <option value="rejected">
                                        Reject
                                    </option>

                                    <option value="correction">
                                        Correction
                                    </option>

                                </select>

                                <button type="submit"
                                        class="btn btn-primary btn-sm w-100">

                                    Update

                                </button>

                            </form>

                        </td>

                        <td>

                            <div class="d-flex gap-2">

                                <a href="{{ route('admin.task.submissions.edit', $item->id) }}"
                                   class="btn btn-warning btn-sm">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <form action="{{ route('admin.task.submissions.delete', $item->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this submission?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="9"
                            class="text-center text-danger py-4">

                            No Submitted Tasks Found

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection