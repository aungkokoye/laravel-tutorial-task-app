@extends('layout.main')

@section('header-title')
    edit-task
@endsection

@section('page-title', 'Task Edit Form')

@section('content')
    @include('form.task', ['task' => $task])
@endsection
