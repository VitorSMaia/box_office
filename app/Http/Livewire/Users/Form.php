<?php

namespace App\Http\Livewire\Users;

use App\Http\Controllers\UserController;
use App\Models\User;
use App\Traits\ModalCenter;
use Livewire\Component;

class Form extends Component
{
    use ModalCenter;

    public $state;
    public $user_id;

    public function mount($id = null)
    {
        if($id) {
            $this->user_id = $id;
            $this->getUser();
        }
    }

    public function getUser()
    {
        $userController = new UserController();

        $userControllerReturn = $userController->find($this->user_id);

        if($userControllerReturn['status'] === 'success') {
            $this->state = $userControllerReturn['data']->toArray();
        }
    }

    public function save()
    {
        $userController = new UserController();

        $userControllerReturn = $userController->updateOrCreate($this->user_id, $this->state);

        if($userControllerReturn['status'] === 'success') {
            $this->openToast('Usuário cadastrado/editado com sucesso!', 'check_circle', 'green');
        } else {
            $this->openToast('Usuário não cadastrado!', 'delete', 'red');
        }

        $this->close();
        $this->emit('refreshUserTable');
    }

    public function render()
    {
        return view('livewire.users.form');
    }
}
