<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('admin')) {
                abort(403);
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $query = Role::query();

        if ($keyword) {
            $query->where('name', 'like', "%{$keyword}%")
                  ->orWhere('display_name', 'like', "%{$keyword}%");
        }

        $roles = $query->latest()->paginate(10);

        return view('role.index', compact('roles', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::orderBy('group')->orderBy('name')->get();
        return view('role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:roles,name',
            'display_name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description,
        ]);

        $role->permissions()->sync($request->permissions);

        \App\Helpers\LogActivity::addToLog('Tambah Data Role: '.$role->name);

        return redirect()->route('role.index')
            ->with('success', 'Role berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('group')->orderBy('name')->get();
        return view('role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:roles,name,'.$role->id,
            'display_name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description,
        ]);

        $role->permissions()->sync($request->permissions);

        \App\Helpers\LogActivity::addToLog('Update Data Role: '.$role->name);

        return redirect()->route('role.index')
            ->with('success', 'Role berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        // Prevent deleting role if any user assigned
        if ($role->users()->exists()) {
            return redirect()->back()
                ->with('error', 'Role tidak dapat dihapus karena masih digunakan oleh pengguna.');
        }

        $role->permissions()->detach();
        $role->delete();

        \App\Helpers\LogActivity::addToLog('Hapus Data Role: '.$role->name);

        return redirect()->route('role.index')
            ->with('success', 'Role berhasil dihapus.');
    }

    /**
     * Show permissions assignment form for a role.
     */
    public function permissions(Role $role)
    {
        $permissions = Permission::orderBy('group')->orderBy('name')->get();
        return view('role.permissions', compact('role', 'permissions'));
    }

    /**
     * Update permissions for a role.
     */
    public function updatePermissions(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->permissions()->sync($request->permissions);

        \App\Helpers\LogActivity::addToLog('Update izin Role: '.$role->name);

        return redirect()->back()
            ->with('success', 'Izins role berhasil diperbarui.');
    }
}