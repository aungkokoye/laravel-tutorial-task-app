<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('task.index');
});

Route::get('/tasks', function() {
    return view(
        'task.index',
        [
            'tasks' => Task::latest()->paginate(5),
        ]
    );
})->name('task.index');

Route::get('/tasks/create', function() {
    return view('task.create');
})->name('task.create');

Route::get('/tasks/{task}/edit', function(Task $task) {
    return view('task.edit', compact('task'));
})->name('task.edit');

Route::get('/tasks/{task}', function(Task $task) {
    return view(
        'task.show',
        compact('task')
    );
})->name('task.show');

Route::post('/tasks', function(TaskRequest $request) {
    $task = Task::create($request->validated());
    return redirect()->route('task.show', $task)->with('success', 'Task create successfully');
})->name('task.store');

Route::put('/tasks/{task}', function(Task $task, TaskRequest $request) {
    $task->update($request->validated());
    return redirect()->route('task.show', $task)->with('success', 'Task edit successfully');
})->name('task.update');

Route::put('/tasks/{task}/toggle-complete', function(Task $task) {
    $task->toggleCompletedAttribute();
    return redirect()->back()->with('success', 'Task completed attribute update successfully');
})->name('task.toggle-complete');

Route::delete('/tasks/{task}', function(Task $task) {
    $task->delete();
    return redirect()->route('task.index')->with('success', 'Task delete successfully');
})->name('task.destroy');
