<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'title',
        'content',
        'start_at',
        'finish_at',
        'finished_at'
    ];

    public function projects(){
        return $this->belongsTo(Project::class, 'project_id');
    }
}