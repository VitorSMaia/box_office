<?php

namespace App\Http\Livewire\Components;

use App\Traits\ModalCenter;
use Livewire\Component;

class Button extends Component
{
    use ModalCenter;
    public $idRegister;
    public $component;
    public $name;

    public function mount($name = null, $component = null, $idRegister = null)
    {
        $this->name = $name;
        $this->component = $component;
        $this->idRegister = $idRegister;
    }

    public function render()
    {
        return view('livewire.components.button');
    }
}
