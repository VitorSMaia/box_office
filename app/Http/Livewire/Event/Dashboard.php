<?php

namespace App\Http\Livewire\Event;

use App\Http\Controllers\EventController;
use App\Traits\ModalCenter;
use Livewire\Component;

class Dashboard extends Component
{
    use ModalCenter;

    public $events;
    public function getEvents() {
        $eventController = new EventController;
        $eventControllerReturn = $eventController->index();

        if($eventControllerReturn['status'] === 'success') {
            $this->events =  $eventControllerReturn['data'];
        }
    }

    public function render()
    {
        $this->getEvents();
        return view('livewire.event.dashboard');
    }
}
