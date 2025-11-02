@extends('layout.main')

@section('header-title')
    create-task
@endsection

@section('page-title', 'Task Create Form')

@section('content')
    @include('form.task')
@endsection
