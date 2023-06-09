<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $userDB = User::query()->with('roles')->get();

        return [
            'status' => 'success',
            'data' => $userDB
        ];
    }

    public function find($idUser = null)
    {
        $userDB = User::query()->findOrFail($idUser);

        return [
            'status' => 'success',
            'data' => $userDB
        ];
    }

    public function updateOrCreate($idUser = null, $request)
    {
        $validatorRequest = Validator::make($request, [
            'name' => 'required',
            'email' => 'required|email',
        ])->validate();

        if($idUser) {
            User::query()->findOrFail($idUser)->update($validatorRequest);
        }else {
            Role::query()->create($validatorRequest);
        }

        return [
            'status' => 'success',
        ];
    }

    public function delete($id = null)
    {
        User::query()->findOrFail($id)->delete();

        return [
            'status' => 'success'
        ];
    }
}
