@section('content')

<form method="POST" action="{{ isset($task) ? route('task.update', ['task' => $task->id]) : route('task.store') }}">
    @csrf
    @isset($task)
        @method('PUT')
    @endisset


    <div class="mb-4">
        <label for="name" class="label">Name</label>
        <input type="text" name="name" id="name" value="{{ isset($task) ?  old('name', $task->name) : old('name') }}"
            @class([
                        'input',
                        'border-red-500 bg-red-200' => $errors->has('name'),
                    ])
        />
        @if ($errors->has('name'))
            <span class="text-red-500 mt-4">{{ $errors->first('name') }}</span>
        @endif
    </div>

<div class="mb-4">
    <label for="description" class="label">Description</label>
    <textarea name="description" id="description" rows="3"
                @class([
                            'textarea',
                            'border-red-500 bg-red-200' => $errors->has('description'),
                ])
            >{{ isset($task) ?  old('description', $task->description) : old('description')  }}</textarea>
    @if ($errors->has('description'))
        <span class="text-red-500 mt-20">{{ $errors->first('description') }}</span>
    @endif
</div>

<div class="mb-4">
    <label for="long_description" class="label">Full Description</label>
    <textarea name="long_description" id="long_description" rows="5"
                @class([
                        'textarea',
                        'border-red-500 bg-red-200' => $errors->has('long_description'),
                ])
            >{{ isset($task) ?  old('long_description', $task->long_description) : old('long_description') }}</textarea>
    @if ($errors->has('long_description'))
        <span class="text-red-500 mt-4">{{ $errors->first('long_description') }}</span>
    @endif
</div>

<div class="mb-4 flex gap-4">
    <button type="submit" class="btn-m btn-primary"> {{ isset($task) ? 'Edit' : 'Create' }} </button>
    <a href="{{ route('task.index') }}" class="btn-m btn-default"> Back to List View </a>
</div>
</form>
@endsection
