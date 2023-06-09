<?php

namespace App\Http\Livewire\Tickets;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Table extends Component
{
    public $tickets;

    public function getTickets()
    {
        $this->tickets = Ticket::query()->where('user_id', Auth::user()->id)
            ->with('event', 'user')->get()->toArray();
    }

    public function render()
    {
        $this->getTickets();
        return view('livewire.tickets.table');
    }
}
