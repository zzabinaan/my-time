<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class todo extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function createTodo(array $attributes)
    {
        $todo = new self();
        $todo->title = $attributes['title'];
        $todo->content = $attributes['content'];
        $todo->start_at = $attributes['start_at'];
        $todo->finish_at = $attributes['finish_at'];
        $todo->finished_at = $attributes['finished_at'];
        $todo->save();
        return $todo;
    }

    public function getTodo($id)
    {
        $todo = todo::firstwhere('id', $id);
        return $todo;
    }

    public function getAllTodo()
    {
        $todos = todo::all(); //nanti diganti jadi where id projects 
        return $todos;
    }

    // public function updateTodo(todo $id, array $attributes)
    public function updateTodo($id, array $attributes)
    {
        $todo = $this->getTodo($id);
        if ($todo == null) {
            throw new ModelNotFoundException(message: "oops, can't find to-do");
        }
        // $todo->project_id = $attributes['project_id'];
        $todo->title = $attributes['title'];
        $todo->content = $attributes['content'];
        $todo->start_at = $attributes['start_at'];
        $todo->finish_at = $attributes['finish_at'];
        $todo->finished_at = $attributes['finished_at'];;
        $todo->save();

        return $todo;
    }

    public function deleteTodo($id)
    {
        $todo = $this->getTodo($id);
        return $todo->delete();
    }
}
