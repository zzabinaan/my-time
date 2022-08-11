<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'name',
        'start_at',
        'finish_at'
    ];

    public function todos(){
        return $this->hasMany(Todo::class);
    }
    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}