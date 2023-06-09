<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Toast extends Component
{
    public $message = null;
    public $show = false;
    public $color = '';
    public $icon = 'check_circle';

    protected $listeners = [
        'openToast' => 'open',
        'closeToast' => 'close'
    ];

    public function open($message = null, $icon = null, $color = null)
    {
        $this->show = true;
        $this->message = $message;
        $this->icon = $icon;
        $this->color = $color;
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
