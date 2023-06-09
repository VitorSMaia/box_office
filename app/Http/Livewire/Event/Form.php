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

            $eventControllerReturn['data']['value'] = formart_decimal($eventControllerReturn['data']['value']);
            $this->state = $eventControllerReturn['data'];
        }
    }

    public function save()
    {
        $eventController = new EventController;

        $eventControllerReturn = $eventController->updateOrCreate($this->event_id,$this->state);

        if($eventControllerReturn['status'] === 'success') {
            $this->openToast('Role cadastrado/editado com sucesso!', 'check_circle', 'green');
        } else {
            $this->openToast('Role não cadastrado!', 'delete', 'red');
        }

        $this->emit('refreshEventTable');
        $this->close();
    }
    public function render()
    {
        return view('livewire.event.form');
    }
}
