<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'required|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
            'status'      => 'required|in:pending,in_progress,completed',
            'due_date'    => 'nullable|date|after_or_equal:today',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'       => 'Task title is required.',
            'assigned_to.required'=> 'Please select a team member.',
            'due_date.after_or_equal' => 'Due date must be today or later.',
        ];
    }
}
