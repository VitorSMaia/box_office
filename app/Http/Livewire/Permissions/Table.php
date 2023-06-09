<?php

namespace App\Http\Livewire\Permissions;

use App\Http\Controllers\RoleController;
use App\Traits\ModalCenter;
use Livewire\Component;

class Table extends Component
{
    use ModalCenter;

    protected $listeners = [
        'dropRole',
        'refreshPermissionTable' => '$refresh'
    ];
    public $state;
    public $roles;

    public function getRoles()
    {
        $roleController = new RoleController;
        $roleControllerReturn = $roleController->index();

        if($roleControllerReturn['status'] === 'success') {
            $this->roles = $roleControllerReturn['data']->toArray();
        }
    }

    public function dropRole($choice)
    {
        $roleController = new RoleController;
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
        $this->getRoles();
        return view('livewire.permissions.table');
    }
}
