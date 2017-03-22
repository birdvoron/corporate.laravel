<?php

namespace Corp\Http\Controllers\admin;

use Corp\Repositories\PermissionsRepository;
use Corp\Repositories\RolesRepository;
use Illuminate\Http\Request;
use Gate;
use Corp\Http\Requests;
use Corp\Http\Controllers\Controller;

class PermissionsController extends AdminController
{
    
    protected $per_rep;
    protected $rol_rep;
    
    public function __construct(PermissionsRepository $per_rep, RolesRepository $rol_rep)
    {
        parent::__construct();
        if(Gate::denies('EDIT_USERS')) {
            abort(403);
        }
        $this->per_rep = $per_rep;
        $this->rol_rep = $rol_rep;
        $this->template = env('THEME') . '.admin.permissions';
        
    }
    
    public function store(Request $request) {
        //dd($request);
        $result = $this->per_rep->changePermissions($request);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return back()->with($result);
        
    }

    public function index() {
        $this->title = "Менеджер прав пользователей";
        $roles = $this->getRoles();
        $permissions = $this->getPermissions();
        $this->content = view(env('THEME').'.admin.permissions_content')->with(['roles'=>$roles,'permissions'=>$permissions])->render();
        return $this->renderOutput();
    }

    public function getRoles() {
        $roles = $this->rol_rep->get();
        return $roles;
    }
    public function getPermissions() {
        $permissions = $this->per_rep->get();
        return $permissions;
    }
}
