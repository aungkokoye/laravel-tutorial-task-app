@extends('layout.main')

@section('header-title')
    main-task
@endsection


@section('page-title', 'Task List')

@section('content')
    <div class="flex-container justify-end ">
        <a href="{{ route('task.create') }}" class="btn-m btn-primary"> Create New Task </a>
    </div>


    <ul>
    @forelse($tasks as $task)
            <li @class(['line-through' => $task->completed, 'hover:text-amber-700'])><a href="/tasks/{{ $task->id }}"> {{ $task->name }} </a></li>
    @empty
        <li>No tasks found.</li>
    @endforelse
    </ul>

    <div>
        {{ $tasks->links() }}
    </div>
@endsection
