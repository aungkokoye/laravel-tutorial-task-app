<?php

use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('task.index');
});

Route::get('/tasks', function() {
    return view(
        'task.index',
        [
            'tasks' => Task::all()->where('completed', true),
        ]
    );
})->name('task.index');


Route::get('/tasks/{task}', function(Task $task) {
    return view(
        'task.show',
        compact('task')
    );
})->name('task.show');
