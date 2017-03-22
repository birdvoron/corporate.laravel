<?php
/**
 * Created by PhpStorm.
 * User: Юрий
 * Date: 21.03.2017
 * Time: 13:12
 */

namespace Corp\Repositories;


use Corp\Role;

class RolesRepository extends Repository
{
    public function __construct(Role $role)
    {
        $this->model = $role;
    }
}