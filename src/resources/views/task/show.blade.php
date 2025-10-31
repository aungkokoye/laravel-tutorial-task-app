@extends('layout.main')

@section('header-title')
    show-task
@endsection

@section('page-title')
    <h2>Task Details</h2>
@endsection

@section('content')
    <h2> {{ $task->name }}</h2>
    <p>
        {{ $task->description }}
    </p>
    @if($task->longDescription)
        <p>
            {{ $task->longDescription }}
        </p>
    @endif

    <p> {{ $task->updatedAt }} </p>
@endsection
