<?php

namespace App\Traits;

use App\Models\Permission;

trait HasPermissions
{
    public function hasPermissionTo(...$permissions)
    {
        // $user->hasPermissionTo('edit-user', 'edit-issue');
        return $this->permissions()->whereIn('slug', $permissions)->count() ||
            $this->roles()->whereHas('permissions', function ($q) use ($permissions) {
                $q->whereIn('slug', $permissions);
            })->count();
    }

    private function getPermissionIdsBySlug($permissions)
    {
        //?Get array of IDs permissions witch permissions of User.
        return Permission::whereIn('slug', $permissions)->get()->pluck('id')->toArray();
    }

    //método para adjuntar un rol a un usuario insertando un registro en la tabla intermedia de la relación:
    //dar permisos a ...
    public function givePermissionTo(...$permissions)
    {
        //?Attach
        //?Agregar un ID en una tabla intermediaria
        $this->permissions()->attach($this->getPermissionIdsBySlug($permissions));
    }
    //para la tabla intermedia
    // solo existirán las ID en la matriz dada en la tabla intermedia:
    public function setPermissions(...$permissions)
    {
        //?ASYNC
        //?Agregar varios IDs a una tabla intermediaria (Array)
        //?Importante: sincronizara, reemplaza o actualiza los registros con los nuevos datos.
        $this->permissions()->sync($this->getPermissionIdsBySlug($permissions));
    }
    //eliminar permisos de la tabla intermedia
    public function detachPermissions(...$permissions)
    {
        $this->permissions()->detach($this->getPermissionIdsBySlug($permissions));
    }
}
