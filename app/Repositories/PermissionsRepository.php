<?php
/**
 * Created by PhpStorm.
 * User: Юрий
 * Date: 21.03.2017
 * Time: 13:12
 */

namespace Corp\Repositories;
use Gate;


use Corp\Permission;

class PermissionsRepository extends Repository
{
    protected $rol_rep;
    public function __construct(Permission $permission, RolesRepository $rol_rep)
    {
        $this->rol_rep = $rol_rep;
        $this->model = $permission;
    }

    public function changePermissions($request) {
        if(Gate::denies('change',$this->model)) {
            return abort(403);
        }
        $data = $request->except('_token');
        $roles = $this->rol_rep->get();
        foreach ($roles as $value) {
            if (isset($data[$value->id])) {
                $value->savePermissions($data[$value->id]);
            }
            else {
                $value->savePermissions([]);
            }

        }
        return ['status'=>'Права обновлены'];
    }
}