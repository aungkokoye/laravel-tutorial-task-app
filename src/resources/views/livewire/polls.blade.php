<div>
    <h1 class="text-2xl mb-4"> All Polls </h1>

    @forelse($polls as $poll)
        <div class="max-w mx-auto bg-white border border-gray-200 rounded-lg shadow-md p-4 mb-4">
            <h2 class="text-lg text-gray-500 mb-4"> {{ $poll->title  }}</h2>
            @foreach($poll->options as $option)
                <div class="flex items-center justify-between max-w mx-auto mb-4">
                    <span class="text-gray-700"> {{ $option->name }}: {{ $option->votes->count() }} </span>
                    <button type="button" class="btn btn-primary right-auto" wire:click.prevent="vote({{ $option->id }})"> Vote </button>
                </div>
            @endforeach
        </div>
    @empty
        <div class="text-gray-700 mb-4"> There is no polls.</div>
    @endforelse

</div>
