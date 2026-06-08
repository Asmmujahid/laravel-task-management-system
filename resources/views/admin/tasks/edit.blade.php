@extends('layout.app')

@section('content')
<div class="content-container">

    <h2>Edit Task: {{ $task->title }}</h2>

    <form action="{{ route('admin.tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div class="form-group mb-3">
            <label>Title</label>
            <input type="text"
                   name="title"
                   value="{{ old('title', $task->title) }}"
                   class="form-control">

            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Description --}}
        <div class="form-group mb-3">
            <label>Description</label>

            <textarea name="description"
                      class="form-control"
                      rows="4">{{ old('description', $task->description) }}</textarea>

            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Assigned To --}}
        <div class="form-group mb-3">
            <label>Assigned To</label>

            <select name="assigned_to"
                    class="form-control"
                    required>

                <option value="">Select User</option>

                @foreach($users as $user)

                    <option value="{{ $user->id }}"
                        {{ old('assigned_to', $task->assigned_to) == $user->id ? 'selected' : '' }}>

                        {{ $user->name }}

                    </option>

                @endforeach

            </select>

            @error('assigned_to')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>

        {{-- Category --}}
        <div class="form-group mb-3">
            <label>Category</label>

            <select name="category_id"
                    class="form-control">

                <option value="">Select Category</option>

                @foreach($categories as $category)

                    <option value="{{ $category->id }}"
                        {{ old('category_id', $task->category_id) == $category->id ? 'selected' : '' }}>

                        {{ $category->name }}

                    </option>

                @endforeach

            </select>

            @error('category_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>

        {{-- Status --}}
        <div class="form-group mb-3">
            <label>Status</label>

            <select name="status"
                    class="form-control">

                <option value="pending"
                    {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="in_progress"
                    {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>
                    In Progress
                </option>

                <option value="completed"
                    {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>
                    Completed
                </option>

            </select>

            @error('status')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>

        {{-- Due Date --}}
        <div class="form-group mb-4">
            <label>Due Date</label>

            <input type="date"
                   name="due_date"
                   class="form-control"
                   value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}">

            @error('due_date')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>

        {{-- Buttons --}}
        <button type="submit" class="btn btn-success">
            Update Task
        </button>

        <a href="{{ route('admin.tasks.index') }}"
           class="btn btn-secondary">
            Back
        </a>

    </form>

</div>
@endsection