<?php

namespace App\Livewire;

use App\Models\Poll;
use Illuminate\View\View;
use Livewire\Component;

class CreatePoll extends Component
{
    public $title;
    public $options = ['First Option'];

    protected $rules = [
        'title'     => 'required|string|max:20',
        'options'   => 'required|array',
        'options.*' => 'required|string|min:3|max:30',
    ];

    protected $messages = [
        'title.required'       => 'The poll title is required.',
        'title.string'         => 'The poll title must be a string.',
        'title.max'            => 'The poll title may not be greater than 20 characters.',
        'options.required'     => 'At least one option is required.',
        'options.array'        => 'The options must be an array.',
        'options.*.required'   => 'Each option is required.',
        'options.*.string'     => 'Each option must be a string.',
        'options.*.min'        => 'Each option must be at least 3 characters.',
        'options.*.max'        => 'Each option may not be greater than 30 characters.',
    ];

    public function render(): View
    {
        return view('livewire.create-poll');
    }

    public function createPoll(): void
    {
        $this->validate();

        Poll::create(
            ['title' => $this->title]
        )->options()->createMany(
            array_map(fn ($option) => ['name' => $option], $this->options)
        );

        $this->reset(['title', 'options']);
        $this->dispatch('poll-created')->to(Polls::class);
    }

    public function addOption(): void
    {
        $this->options[] = '';
    }

    public function removeOption($index): void
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }
}
