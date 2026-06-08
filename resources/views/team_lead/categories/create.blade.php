@extends('layout.app')

@section('content')
<div class="container">
    <h2>Add Category</h2>

    <form method="POST" action="{{ route('team_lead.categories.store') }}">
        @csrf

        <div class="mb-3">
            <label>Category Name</label>
            <input type="text" name="name" class="form-control">
            @error('name') 
                <span class="text-danger">{{ $message }}</span> 
            @enderror
        </div>

        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection