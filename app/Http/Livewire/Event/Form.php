<?php

namespace App\Http\Livewire\Event;

use App\Http\Controllers\EventController;
use App\Traits\ModalCenter;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use ModalCenter, WithFileUploads;

    public $event_id = null;
    public $updateImage = null;
    public $isUploading = false;

    public $state = [
        'tickets' => [
            9 => 0,
            10 => 0,
            11 => 0,
            12 => 0,
            13 => 0,
            14 => 0,
            15 => 0,
            16 => 0,
            17 => 0,
        ]
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

            $this->state = $eventControllerReturn['data'];
            $this->state['value'] = formart_decimal($eventControllerReturn['data']['value'], true);
        }
    }

    public function UpdatedStateImage()
    {
        $this->updateImage = true;
    }

    public function save()
    {
        $eventController = new EventController;

        $eventControllerReturn = $eventController->updateOrCreate($this->event_id,$this->state);

        if($eventControllerReturn['status'] === 'success') {
            $this->openToast('Evento cadastrado/editado com sucesso!', 'check_circle', 'green');
        } else {
            $this->openToast('Evento não cadastrado!', 'delete', 'red');
        }

        $this->emit('refreshEventTable');
        $this->close();
    }
    public function render()
    {
        return view('livewire.event.form');
    }
}
