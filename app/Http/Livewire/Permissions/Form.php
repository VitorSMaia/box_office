<?php

namespace App\Http\Livewire\Permissions;

use App\Http\Controllers\RoleController;
use App\Traits\ModalCenter;
use Livewire\Component;

class Form extends Component
{
    use ModalCenter;

    public $state = [];
    public $role_id;
    public $roles;

    public function mount($id = null)
    {
        if($id) {
            $this->role_id = $id;
            $this->getRole();
        }
    }

    public function getRole()
    {
        $roleController = new RoleController;

        $roleControllerReturn = $roleController->find($this->role_id);

        if($roleControllerReturn['status'] === 'success') {
            $this->state = $roleControllerReturn['data']->toArray();
        }
    }

    public function save()
    {
        $roleController = new RoleController;

        $roleControllerReturn = $roleController->updateOrCreate($this->role_id, $this->state);

        if($roleControllerReturn['status'] === 'success') {
            $this->openToast('Role Cadastrador');
            $this->close();
            $this->emit('refreshPermissionTable');
        }
    }

    public function render()
    {
        return view('livewire.permissions.form');
    }
}
