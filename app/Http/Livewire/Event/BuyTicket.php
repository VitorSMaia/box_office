<?php

namespace App\Http\Livewire\Event;

use App\Http\Controllers\EventController;
use App\Traits\ModalCenter;
use Livewire\Component;

class BuyTicket extends Component
{
    use ModalCenter;
    public $hours;
    public $event_id;
    public $event;
    public $state = [
        'date' => '',
        'hour' => ''
    ];

    public function mount($id = null)
    {
        if($id) {
            $this->event_id = $id;
            $this->getEvent();
            $this->getHours();
        }
    }
    public function getEvent()
    {
        $eventController = new EventController;
        $eventControllerReturn = $eventController->find($this->event_id);

        if($eventControllerReturn['status'] === 'success') {
            $this->event = $eventControllerReturn['data'];
        }
    }
    public function getHours()
    {
        $eventController = new EventController;
        $eventControllerReturn = $eventController->getHours($this->event_id);

        if($eventControllerReturn['status'] === 'success') {
            $this->hours = $eventControllerReturn['data'];

        }
    }

    public function save()
    {
        $eventController = new EventController;
        $eventControllerReturn = $eventController->buyTicket($this->event_id, $this->state);

        if($eventControllerReturn['status'] === 'success') {
            $this->close();
            $this->openToast('Ingressos enviados ao seu email! Aproveite o evento!');
        }
    }
    public function render()
    {
        return view('livewire.event.buy-ticket');
    }
}
