<?php

namespace App\Livewire;

use App\Models\Option;
use App\Models\Poll;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Attributes\On;

class Polls extends Component
{
    #[On('poll-created')]
    public function render(): View
    {
        $polls = Poll::with('options.votes')->latest()->get();

        return view('livewire.polls', ['polls' => $polls]);
    }

    public function vote(Option $option): void
    {
        $option->votes()->create([]);
    }
}
