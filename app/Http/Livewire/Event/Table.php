<?php

namespace App\Http\Livewire\Event;

use App\Http\Controllers\EventController;
use App\Traits\ModalCenter;
use Livewire\Component;

class Table extends Component
{
    use ModalCenter;

    public $events;
    protected $listeners = [
        'refreshEventTable' => '$refresh',
        'dropEvent'
    ];

    public function mount() {

    }

    public function getEvent() {
        $eventController = new EventController;
        $eventControllerReturn = $eventController->index();

        if($eventControllerReturn['status'] === 'success') {
            $this->events =  $eventControllerReturn['data'];
        }
    }

    public function dropEvent($choice) {
        $eventController = new EventController;

        if($choice['choice']) {
            $eventControllerReturn = $eventController->delete($choice['id']);

            if ($eventControllerReturn['status'] === 'success') {
                $this->close();
                $this->emit('refreshEventTable');
            }
        }
    }

    public function render() {
        $this->getEvent();
        return view('livewire.event.table');
    }
}
