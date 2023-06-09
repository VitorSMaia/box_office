<?php

namespace App\Http\Livewire\Event;

use App\Http\Controllers\EventController;
use App\Traits\ModalCenter;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use ModalCenter, WithFileUploads;

    public $schedules = [
        9,10,11,12,13,14,15,16,17
    ];

    public $event_id = null;

    public $state = [
        'ticket' => [],
//        'image' => null
    ];

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

            $array = [];
            $array2 = [];

            foreach ($eventControllerReturn['data']['tickets'] as $key => $item) {
                $array[$item['hour']][] = $item;
            }

            foreach ($array as $key => $item) {
                $array2[$key] = count($item);
            }

            $eventControllerReturn['data']['ticket'] = $array2;

            $this->state = $eventControllerReturn['data'];
        }
    }

    public function save()
    {
        $eventController = new EventController

        $eventControllerReturn = $eventController->updateOrCreate($this->event_id,$this->state);

        if($eventControllerReturn['status'] === 'success') {
            $this->close();
            $this->emit('refreshEventTable');
        }
    }
    public function render()
    {
        return view('livewire.event.form');
    }
}
