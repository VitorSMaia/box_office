<?php

namespace App\Http\Livewire\Users;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Traits\ModalCenter;
use Livewire\Component;

class Table extends Component
{
    use ModalCenter;
    protected $listeners = [
        'dropUser',
        'refreshUserTable' => '$refresh'
    ];
    public $state;
    public $users;

    public function getUsers()
    {
        $roleController = new UserController();
        $roleControllerReturn = $roleController->index();

        if($roleControllerReturn['status'] === 'success') {
            $this->users = $roleControllerReturn['data']->toArray();
        }
    }
    public function dropUser($choice)
    {
        $roleController = new UserController();
        $roleControllerReturn = $roleController->delete($choice['id']);

        if($choice['choice']) {
            if ($roleControllerReturn['status'] === 'success') {
                $this->close();
                $this->emit('refreshPermissionTable');
            }
        }
    }

    public function render()
    {
        $this->getUsers();
        return view('livewire.users.table');
    }
}
