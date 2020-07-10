<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Todo;

class TodoController extends Controller
{
    function index()
    {
        return Todo::all();
    }
    function store(Request $request)
    {
        $todo = Todo::create([
            'title' => $request->title,
            'done' => false
        ]);
        return response()->json($todo);
    }
    function update(Request $request, $todoId)
    {
        $todo = Todo::find($todoId);
        $todo->update([
            'title' => $request->title,
            'done' => $request->done
        ]);
        return response()->json($todo);
    }
    function destroy($todoId)
    {
        $todo = Todo::find($todoId);
        $todo->delete();
        return response()->json($todo);
    }
}
