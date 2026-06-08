<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'task_id',
        'category_id',
        'user_id',
        'comment',
        'review',
         'lead_submit',
         'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
     public function category()
    {
        return $this->belongsTo(Category::class);
    }
}