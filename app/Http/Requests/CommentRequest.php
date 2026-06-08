<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'task_id' => 'required|exists:tasks,id',
            'user_id' => 'required|exists:users,id',
            'comment' => 'required|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'comment.required' => 'Please enter a comment before submitting.',
            'task_id.exists' => 'The selected task is invalid.',
            'user_id.exists' => 'The selected user is invalid.',
        ];
    }
}
