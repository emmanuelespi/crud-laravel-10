<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $task = Task::latest()->paginate(3);
        return view('index', ['tasks' => $task]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        Task::create($request->all());
        return redirect()->route('tasks.index')->with('success', '¡Nueva tarea creada!');
    }

    /**
     * Display the specified resource.
     */
    public function show(task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(task $task) : View
    {
        return view('edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, task $task) : RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success', '¡Tarea editada correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', '¡Tarea eliminada correctamente!');
    }
}
