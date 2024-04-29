<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Mail\RoleAssignedMail;
use Illuminate\Support\Facades\Mail;



class UserController extends Controller
{
    /**
     * Display a listing of users with their roles.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Retrieve the role filter from the request
        $filterRole = $request->input('role');
    
        // Adjust the query based on whether a role filter has been applied
        $users = User::with('roles')->when($filterRole, function ($query) use ($filterRole) {
            return $query->whereHas('roles', function ($q) use ($filterRole) {
                $q->where('name', $filterRole);
            });
        })->get();
    
        // Count the number of filtered results
        $count = $users->count();
    
        // Retrieve all roles to populate the role filter dropdown in the view
        $roles = Role::all();
    
        // Pass the list of users and roles to the view, including the current filter selection and count
        return view('usermgmt.index', compact('users', 'roles', 'filterRole', 'count'));
    }
    
    

    /**
     * Show the form for editing the specified user along with roles and permissions.
     *
     * @param  User $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $roles = Role::all(); // Get all roles
        $permissions = Permission::all(); // Get all permissions
        return view('usermgmt.edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        \Log::info("User ID: {$user->user_id}");
        \Log::info("Request Data: " . json_encode($request->all())); 
    
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
        ]);
    
        $user->update($validatedData);
    
        // Handling role assignment for multiple roles
        if ($request->has('roles')) { // Make sure to check for 'roles' not 'role'
            $user->syncRoles($request->roles);
            foreach ($request->roles as $roleName) {
                // You might send an email for each role assigned, or modify this logic as needed
                // Mail::to($user->email)->send(new \App\Mail\RoleAssignedMail($user, $roleName));
            }
        }
    
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
    
    
    /**
     * Remove the specified user from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        if (!auth()->user()->can('delete users')) {
            return redirect()->route('users.index')->with('error', 'Unauthorized to perform this action.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    // Additional methods can be added here
}
