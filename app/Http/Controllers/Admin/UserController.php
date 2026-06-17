<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{

    public function index()
    {
        $users = User::with(['position', 'office', 'roles'])->get();
        return view('admin.users.index', compact('users'));
    }



    public function getData()
    {
        // return a query builder, not ->get()
        $query = User::with(['position', 'office', 'roles']);

        return DataTables::eloquent($query)  // <-- this is efficient
            ->addIndexColumn()
            ->addColumn('roles', function ($user) {
                return $user->roles
                    ->map(fn($role) => "<span class='badge bg-success'>{$role->name}</span>")
                    ->implode(' ');
            })
            ->addColumn('actions', function ($user) {
                return '
                    <a href="'.route('admin.users.edit', $user->id).'" class="btn btn-sm btn-warning">Edit</a>
                    <form action="'.route('admin.users.destroy', $user->id).'" method="POST" style="display:inline;">
                        '.csrf_field().method_field('DELETE').'
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                ';
            })
            ->rawColumns(['roles', 'actions'])
            ->make(true);
    }

    
    public function show($id)
    {
        $user = User::with(['position', 'office', 'roles'])->findOrFail($id);

        return view('admin.users.show', compact('user'));
    }


    public function create()
    {
        $roles = Role::all();
        $positions = \App\Models\Position::all();
        $offices = \App\Models\Office::all();

        return view('admin.users.create', compact('roles', 'positions', 'offices'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|string|min:6|confirmed',
            'roles'       => 'required|array',
            'employee_no' => 'required|string|max:50|unique:users,employee_no',
            'position_id' => 'required|exists:positions,id',
            'office_id'   => 'required|exists:offices,id',
        ]);

        $user = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => bcrypt($request->password),
            'employee_no' => $request->employee_no,
            'position_id' => $request->position_id,
            'office_id'   => $request->office_id,
        ]);


        $user->syncRoles($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $positions = \App\Models\Position::all();
        $offices = \App\Models\Office::all();

        return view('admin.users.edit', compact('user', 'roles', 'positions', 'offices'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email,' . $user->id,
            'roles'       => 'required|array',
            'employee_no' => 'required|string|max:50|unique:users,employee_no,' . $user->id,
            'position_id' => 'required|exists:positions,id',
            'office_id'   => 'required|exists:offices,id',
        ]);

        $user->update([
            'name'        => $request->name,
            'email'       => $request->email,
            'employee_no' => $request->employee_no,
            'position_id' => $request->position_id,
            'office_id'   => $request->office_id,
        ]);


        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($request->password)]);
        }

        $user->syncRoles($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
