<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class ModalCenter extends Component
{
    public $listeners = [
        'openModalCenter' => 'open',
        'closeModalCenter' => 'close',
        'openModalDropCenter' => 'openDropModal'
    ];

    public $component = false;
    public $showDropModal = false;
    public $idParameter;
    public $choice = false;
    public $show = false;
    public $listener;


    public function open($component = null, $id = null)
    {
        $this->showDropModal = false;
        $this->show = true;
        $this->component = $component;
        $this->idParameter = $id;

    }

    public function openDropModal($id = null, $listener = null)
    {
        $this->showDropModal = true;
        $this->show = true;
        $this->listener = $listener;
        $this->idParameter = $id;
    }

    public function updatedChoice()
    {
        $this->emit($this->listener, ['id' => $this->idParameter, 'choice' => $this->choice]);
    }

    public function close()
    {
        $this->showDropModal = false;
        $this->show = false;
        $this->component = null;
        $this->idParameter = null;
    }

    public function render()
    {
        return view('livewire.components.modal-center');
    }
}
