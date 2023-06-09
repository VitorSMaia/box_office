<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Toast extends Component
{
    public $message = null;
    public $show = false;

    protected $listeners = [
        'openToast' => 'open',
        'closeToast' => 'close'
    ];

    public function open($message = null)
    {
        $this->show = true;
        $this->message = $message;
    }

    public function close()
    {
        $this->show = false;
        $this->message = null;
    }

    public function render()
    {
        return view('livewire.components.toast');
    }
}
