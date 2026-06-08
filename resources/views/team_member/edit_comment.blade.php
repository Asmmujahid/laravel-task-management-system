@extends('layout.app')

@section('content')

<div class="content-container">

    <div class="card shadow">

        <div class="card-header bg-warning">
            <h3>Edit Comment</h3>
        </div>

        <div class="card-body">

            <form action="{{ route('team_member.comments.update',$comment->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">
                        Comment
                    </label>

                    <textarea name="comment"
                              rows="5"
                              class="form-control">{{ $comment->comment }}</textarea>

                </div>

                <button class="btn btn-success">
                    Update
                </button>

                <a href="{{ route('team_member.comments.files') }}"
                   class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>

    </div>

</div>

@endsection