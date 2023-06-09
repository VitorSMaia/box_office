<?php

namespace App\Http\Controllers;

use App\Models\GroupPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roleDB = Role::query()->with('permissions')->get();

        return [
            'status' => 'success',
            'data' => $roleDB
        ];
    }

    public function find($idRole = null)
    {
        $roleDB = Role::query()->findOrFail($idRole);

        return [
            'status' => 'success',
            'data' => $roleDB
        ];
    }

    public function updateOrCreate($idRole = null, $request)
    {
        $validatorRequest = Validator::make($request, [
            'name' => 'required',
        ])->validate();

        if($idRole) {
            Role::query()->findOrFail($idRole)->update($validatorRequest);
        }else {
            Role::query()->create($validatorRequest);
        }

        return [
            'status' => 'success',
        ];
    }

    public function delete($id = null)
    {
        Role::query()->findOrFail($id)->delete();

        return [
            'status' => 'success'
        ];
    }

    public function permissions()
    {
        $roleDB = GroupPermission::query()->with('permissons')->get();

        return [
            'status' => 'success',
            'data' => $roleDB
        ];
    }

    public function updateOrCreatePermission($idRole = null, $request)
    {
        $roleDB = Role::query()->findOrFail($idRole);
        $roleDB->syncPermissions($request['groupPermission']);

        return [
            'status' => 'success',
        ];
    }
}
