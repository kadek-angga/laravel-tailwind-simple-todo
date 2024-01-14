<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('todos.index', [
            'todos' => Auth::user()->todos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);
        // dd($request->all());
        return redirect()->route('todos.index')
            ->with('success', 'Todo created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, $id)
    {
        // $todo->update([
        //     'is_done' => true,
        // ]);

        // Retrieve the todo item by id
        $todo = Auth::user()->todos()->findOrFail($id);

        // Toggle the is_done field
        $todo->is_done = !$todo->is_done;

        // Save the changes
        $todo->save();

        return redirect()->route('todos.index')
            ->with('success', 'Todo updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $todo = Auth::user()->todos()->findOrFail($id);
        $todo->delete();

        return redirect()->route('todos.index')
            ->with('success', 'Todo deleted successfully.');
    }
}
