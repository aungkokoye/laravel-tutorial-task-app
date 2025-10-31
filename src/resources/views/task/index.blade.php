@extends('layout.main')

@section('header-title')
    main-task
@endsection


@section('page-title')
    <h2>Total Tasks</h2>
@endsection

@section('content')
    <ul>
    @forelse($tasks as $task)
            <li><a href="/tasks/{{ $task->id }}"> {{ $task->name }} </a></li>
    @empty
        <li>No tasks found.</li>
    @endforelse
    </ul>
@endsection
