<?php

namespace App\Models;

use App\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    use HasPermissions;

    //?get permissions
    public function permissions()
    {
        //( class, tabla intermedia )
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }

    //?Validate Roles of User.
    public function hasPermissionTo(...$permissions)
    {
        // $role->hasPermissionTo('edit-user', 'edit-issue');
        return $this->permissions()->whereIn('slug', $permissions)->count();
    }
}
