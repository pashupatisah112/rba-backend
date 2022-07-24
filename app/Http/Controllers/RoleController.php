<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $role=Role::all();
        return response()->json($role);
    }
    public function store(Request $request)
    {
        $role=new Role;
        $role->role=$request->role;
        $role->save();
        return response()->json($role);
    }

    public function update(Request $request, $id)
    {
        $role=Role::find($id);
        $role->role=$request->role;
        $role->save();
        return response()->json($role);
    }

    public function deleteRole(Request $request)
    {
        
    }
}
