<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::with('permissions')->get(); // Get all roles with their permissions loaded
        $permissions = Permission::all(); // Get all permissions

        return view('roles.index', compact('roles', 'permissions'));
    }

    public function editPermissions($id)
    {
        $role = Role::findById($id);  // Or Role::find($id)
        if (!$role) {
            return redirect()->route('roles.index')->with('error', 'Role not found.');
        }

        $allPermissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('roles.edit_permissions', compact('role', 'allPermissions', 'rolePermissions'));
    }

    // Handle permissions update
    public function updatePermissions(Request $request, $id)
    {
        $role = Role::findById($id);
        if (!$role) {
            return redirect()->back()->with('error', 'Role not found.');
        }
    
        // Fetch permission names from IDs
        $permissions = Permission::whereIn('id', $request->permissions)->pluck('name');
    
        // Sync permissions by names
        $role->syncPermissions($permissions);
    
        return redirect()->route('roles.index')->with('success', 'Permissions updated successfully.');
    }

    public function createPermission()
{
    return view('roles.create_permissions');
}

public function storePermission(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255|unique:permissions,name',
    ]);

    $permission = Permission::create(['name' => $validatedData['name']]);
    
    return redirect()->route('roles.index')->with('success', 'Permission created successfully.');
}
    



}
