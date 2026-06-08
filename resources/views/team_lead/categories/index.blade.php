@extends('layout.app')

@section('content')
<div class="content-container">

    <h2>Task Categories</h2>

    <a href="{{ route('team_lead.categories.create') }}" 
       class="btn btn-primary mb-3">
        + Add Category
    </a>

   <table class="table table-bordered table-striped align-middle">

            <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th width="200">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                <td>

                    <!-- EDIT -->
                    <a href="{{ route('team_lead.categories.edit', $category->id) }}" 
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <!-- DELETE -->
                    <form method="POST" 
                          action="{{ route('team_lead.categories.destroy', $category->id) }}"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm">
                            Delete
                        </button>
                    </form>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">
                    No categories found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection