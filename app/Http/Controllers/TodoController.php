<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        return response()->json(Todo::get());
    }

    public function store(Request $request)
    {
        $todo = Todo::create($request->all());
        return response()->json($todo);
    }

    public function update(Request $request, Todo $todo)
    {
        $todo->update($request->all());
        return response()->json($todo);
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response()->json('deleted');
    }

    public function complete($id)
    {
        $todo = Todo::find($id);
        $todo->update([
            'complete' => 1,
        ]);

        return response()->json('Completed',200);
    }
}
