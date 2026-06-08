@extends('layout.app')

@section('content')

<div class="content-container">

    <h2>All Teams</h2>

    <div class="table-responsive">

         <table class="table table-bordered table-striped align-middle">

            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Team</th>
                    <th>Lead</th>
                    <th>Category</th>
                    <th>Members</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($teams as $team)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $team->name }}</td>

                    <td>{{ $team->lead->name ?? '-' }}</td>

                    <td>{{ optional($team->category)->name ?? 'No Category' }}</td>

                    <td>

                        @forelse($team->members as $member)

                            <span class="badge bg-primary">
                                {{ $member->name }}
                            </span>

                        @empty

                            <span class="text-muted">
                                No Members
                            </span>

                        @endforelse

                    </td>

                    <td>

                        <div class="actions">

                            <a href="{{ route('admin.teams.edit', $team->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.teams.destroy', $team->id) }}"
                                  method="POST"
                                  class="inline-form">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this team?')">
                                    Delete
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6" class="empty">
                        No teams found
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection