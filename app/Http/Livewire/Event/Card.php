<?php

namespace App\Http\Livewire\Event;

use App\Http\Controllers\EventController;
use Livewire\Component;

class Card extends Component
{
    public $event;
    public function mount($id = null)
    {
        if($id) {
            $this->event_id = $id;
            $this->getEvent();
        }
    }

    public function getEvent()
    {
        $eventController = new EventController;
        $eventControllerReturn = $eventController->find($this->event_id);

        if($eventControllerReturn['status'] == 'success') {
            $this->event = $eventControllerReturn['data'];
        }
    }

    public function render()
    {
        $this->getEvent();
        return view('livewire.event.card');
    }
}
