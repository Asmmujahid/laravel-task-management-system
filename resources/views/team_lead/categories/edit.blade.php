@extends('layout.app')

@section('content')
<div class="container">

    <h2>Edit Category</h2>

    <form method="POST" 
          action="{{ route('team_lead.categories.update', $category->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Category Name</label>
            <input type="text" 
                   name="name" 
                   value="{{ old('name', $category->name) }}" 
                   class="form-control">

            @error('name') 
                <span class="text-danger">{{ $message }}</span> 
            @enderror
        </div>

        <button class="btn btn-success">Update</button>
    </form>

</div>
@endsection