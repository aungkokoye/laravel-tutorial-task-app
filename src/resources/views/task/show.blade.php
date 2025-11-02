@extends('layout.main')

@section('header-title')
    show-task
@endsection

@section('page-title', 'Task Details')

@section('content')
    <table class="table-fixed w-full border border-gray-300 text-sm text-left rounded-lg shadow-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border-b border-gray-300 px-4 py-2 text-lg font-semibold text-gray-700">
                    {{ $task->title ?? $task->name }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border-b border-gray-300 px-4 py-3 text-gray-800">
                    {{ $task->description }}
                </td>
            </tr>
        @if(!empty($task->long_description))
            <tr>
                <td class="border-b border-gray-300 px-4 py-3 text-gray-800">
                    {{ $task->long_description }}
                </td>
            </tr>
        @endif
            <tr>
                <td class="border-b border-gray-300 px-4 py-3 text-gray-800">
                    created At: {{ $task->created_at->diffForHumans() }} | Updated At: {{ $task->updated_at->diffForHumans() }}
                </td>
            </tr>
        </tbody>
    </table>

    <div class="flex-container mt-6">
        <a href="{{ route('task.edit', ['task' => $task->id]) }}" class="btn-m btn-primary"> Edit </a>
        <form method="POST" action="{{ route('task.destroy', ['task' => $task->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-m btn-danger">Delete</button>
        </form>
        <form method="POST" action="{{ route('task.toggle-complete', ['task' => $task->id]) }}">
            @csrf
            @method('PUT')
            <button type="submit" class="btn-m btn-primary">{{ $task->completed ? 'Mark As Uncompleted' : 'Mark as Completed' }}</button>
        </form>
        <a href="{{ route('task.index') }}" class="btn-m btn-default"> Back to Task List </a>
    </div>
@endsection
