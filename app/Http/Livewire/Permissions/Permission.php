<?php

namespace App\Http\Livewire\Permissions;

use App\Http\Controllers\RoleController;
use App\Traits\ModalCenter;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Permission extends Component
{
    use ModalCenter;
    public $groupPermission;
    public $state = [
        'groupPermission' => [
            ]
        ];
    public $id_role;

    public function mount($id = null)
    {
        if($id) {
            $this->id_role = $id;
            $this->getRole();
        }
    }

    public function getRole()
    {
        $roleDB = Role::query()->with('permissions')->findOrFail($this->id_role);
        foreach ($roleDB->permissions as $key => $target) {
            $this->state['groupPermission'][] = $target->pivot->permission_id;
        }
    }

    public function getPermissions()
    {
        $roleController = new RoleController;

        $roleControllerReturn = $roleController->permissions();

        if($roleControllerReturn['status'] === 'success') {
            $this->groupPermission = $roleControllerReturn['data']->toArray();
            $this->close();
        }
    }

    public function save()
    {
        $roleController = new RoleController;

        $roleController->updateOrCreatePermission($this->id_role, $this->state);
    }

    public function render()
    {
        $this->getPermissions();
        return view('livewire.permissions.permission');
    }
}
