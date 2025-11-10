<div>
    <form>
        <label for="title">Title</label>
        <input type="text" wire:model.live="title">
        @error('title')
            <div class="error">{{ $message }}</div>
        @enderror
        @error('options')
        <div class="error">{{ $message }}</div>
        @enderror
    </form>
    <button type="button" class="btn btn-primary mt-4 mb-4" wire:click.prevent="addOption">Add Option</button>

    <div class="mb-4">
        @forEach($options as $index => $option)
            <div class="mb-4">
                <label> Option {{ $index + 1 }} </label>
            </div>
            <div class="flex items-center mb-4">
                <input type="text" wire:model.live="options.{{ $index }}">
                <button type="button" class="btn btn-danger ml-2" wire:click.prevent="removeOption({{ $index }})">Remove</button>
            </div>
            @error('options.' . $index)
            <div class="error">{{ $message }}</div>
            @enderror
        @endforeach
    </div>


    <button type="button" class="btn btn-success mt-4" wire:click.prevent="createPoll">Create Poll</button>
</div>
