<?php

namespace App\Livewire;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Attributes\On;
use Livewire\Component;

class TcNotification extends Component
{
    public bool $show = false;

    public string $duration = '5000';
    
    public function mount(): void
    {
        if (session('notification')) {
            $this->notification(session('notification'));
        }
    }

    #[On('notification')]
    public function notification(string $message): void
    {
        $this->show = true;

        session()->flash('notification', $message);
    }

    public function render(): Renderable
    {
        return view('livewire.tc-notification');
    }
}
