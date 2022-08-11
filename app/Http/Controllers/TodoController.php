<?php

namespace App\Http\Controllers;

use App\Models\todo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    protected $todo;
    public function __construct(todo $todo)
    {
        $this->todo = $todo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todo = $this->todo->createTodo($request->all());
        return response()->json($todo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\todo  $todo
     * @return \Illuminate\Http\Response
     */

    public function update($id, Request $request)
    {
        try {
            $todo = $this->todo->updateTodo($id, $request->all());
            response()->json($todo);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['msg' => $exception->getMessage()], status: 404);
        }
    }

    // public function update(todo $todo, Request $request)
    // {
    //     $id = $todo['id'];
    //     try {
    //         $todo = $this->todo->updateTodo($id, $request->all());
    //         response()->json($todo);
    //     } catch (ModelNotFoundException $exception) {
    //         return response()->json(['msg' => $exception->getMessage()], status: 404);
    //     }
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\todo  $todo
     * @return \Illuminate\Http\Response
     */

    // public function get(todo $todo)
    // {
    //     $id = $todo['id'];
    //     $todo = $this->todo->getTodo($id);
    //     if ($todo) {
    //         return response()->json($todo);
    //     } else {
    //         return response()->json(['msg' => "item not found"], status: 404);
    //     }
    // }

    public function get($id)
    {
        $todo = $this->todo->getTodo($id);
        if ($todo) {
            return response()->json($todo);
        } else {
            return response()->json(['msg' => "item not found"], status: 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\todo  $todo
     * @return \Illuminate\Http\Response
     */

    public function gets()
    {
        $todo = $this->todo->getAllTodo();
        return response()->json($todo);
    }

    // public function delete(todo $todo)
    // {
    //     $id = $todo['id'];
    //     try {
    //         $todo = $this->todo->deleteTodo($id);
    //         response()->json($todo);
    //     } catch (ModelNotFoundException $exception) {
    //         return response()->json(['msg' => $exception->getMessage()], status: 404);
    //     }
    // }
    public function delete($id)
    {
        // $id = $todo['id'];
        try {
            $todo = $this->todo->deleteTodo($id);
            response()->json($todo);
            return $todo;
        } catch (ModelNotFoundException $exception) {
            return response()->json(['msg' => $exception->getMessage()], status: 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(todo $todo)
    {
    }
}
