@extends('layout.app')

@section('content')

<div class="content-container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Categories</h2>

        <a href="{{ route('admin.categories.create') }}"
           class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Category
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">

        <table class="table table-bordered table-striped align-middle">

            <thead class="table-dark">
                <tr>
                    <th width="80">#</th>
                    <th>Category Name</th>
                    <th width="220">Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($categories as $category)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <strong>{{ $category->name }}</strong>
                    </td>

                    <td>

                        <div class="d-flex gap-2">

                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this category?')">

                                    <i class="fas fa-trash"></i> Delete

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="3" class="text-center text-muted py-4">
                        No categories found.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection