<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'team_id',
        'assigned_to',
        'created_by',
        'category_id',
        'status',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    // Team
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    // Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Task Creator (Admin / Team Lead)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Assigned Team Member
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function assignedBy()
{
    return $this->belongsTo(User::class, 'assigned_by');
}
    // Comments of Task
    public function comments()
    {
        return $this->hasMany(Comment::class, 'task_id')
                    ->latest();
    }

    // Files of Task
    public function files()
    {
        return $this->hasMany(File::class, 'task_id')
                    ->latest();
    }
}