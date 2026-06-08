@extends('layout.app')

@section('title', 'Users')

@section('content')

<div class="content-container">

    <div class="page-header">
        <h2>Manage Users</h2>
        <p class="subtitle">
            View, edit and manage users in your system.
        </p>
    </div>

    <div class="actions mb-3">
        <a href="{{ route('admin.users.create') }}"
           class="btn btn-primary">
            + Add User
        </a>
    </div>

    <div class="card">

        <div class="table-responsive">

             <table class="table table-bordered table-striped align-middle">

            <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Team</th>
                        <th width="180">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($users as $user)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <strong>{{ $user->name }}</strong>
                        </td>

                        <td>
                            {{ $user->email }}
                        </td>

                        <td>

                            <span class="badge bg-primary">
                                {{ ucfirst($user->role) }}
                            </span>

                        </td>

                        <td>
                            {{ $user->team->name ?? '—' }}
                        </td>

                        <td>

                            <div class="actions">

                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('admin.users.destroy', $user->id) }}"
                                      method="POST"
                                      class="inline-form">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete this user?')">
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="empty">
                            No users found.
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection