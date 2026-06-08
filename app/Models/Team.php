<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'lead_id', 'category_id'
    ];

    public function lead()
    {
        return $this->belongsTo(User::class, 'lead_id');
    }

    public function members()
    {
        return $this->hasMany(User::class, 'team_id');
    }

    public function category()
{
    return $this->belongsTo(Category::class);
}

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
