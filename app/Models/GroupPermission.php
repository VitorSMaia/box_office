<?php

namespace App\Models;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class GroupPermission extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'name'
    ];

    public function permissons()
    {
        return $this->hasMany(Permission::class,'group_permission_id','id');
    }
}
