<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Helpers\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class TodoController extends Controller
{
    public function __construct(todo $todo)
    {
       //load project_id from Project
         $this->todo = $todo;
         Config::set('auth.defaults.guard','admin-api');   
    }
    public function store($project_id,Request $request)
    {
        $data = $this->todo->create([
            'project_id' => $project_id,
            'title' => $request->title,
            'content' => $request->content,
            'start_at' => Carbon::now(),
            'finish_at' => Carbon::now()->addDays(3),
            'finished_at' => null
        ]);
        if($data){
            return response()->json([
            'message' => 'success',
            'data' => $data ], 201);
        }else{
            return response()->json([
            'message' => 'failed',], 400);
        }
    }
    public function show($project_id)
    {
        $data = Project::with('todos')->find($project_id);
        if($data){
            return response()->json([
            'message' => 'success',
            'data' => $data ], 201);
        }else{
            return response()->json([
            'message' => 'failed',], 400);
        }
    }

}
