<?php

namespace App\Traits;

trait ModalCenter
{
    public function open($component = null, $params = [])
    {
        $this->emit('openModalCenter', $component, $params);
    }

    public function close()
    {
        $this->emit('closeModalCenter');
    }

    public function drop($id = null, $listener = null)
    {
        $this->emit('openModalDropCenter', $id, $listener);
    }

    public function openToast($message = null, $icon = null, $color = null)
    {
        $this->emit('openToast', $message, $icon, $color);
    }
    public function closeToast()
    {
        $this->emit('closeToast');
    }
}
