<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with(['roles', 'media'])->select('users.*');

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('avatar', function ($user) {
                    $media = $user->getFirstMedia('avatar');

                    if (! $media) {
                        // return '<img src="https://via.placeholder.com/50x50?text=' . strtoupper(substr($user->name, 0, 1)) . '" alt="avatar" width="50" height="50" class="rounded">';

                        return '<div class="d-flex justify-content-center align-items-center bg-secondary text-white rounded-circle"
                                    style="width:40px; height:40px;">
                                    <i class="fas fa-user"></i>
                                </div>';
                    }

                    $url = $media->getUrl();
                    return '<img src="' . $url . '" alt="' . e($user->name ?? 'User') . '" width="50" height="50" class="rounded-circle">';
                })
                ->addColumn('roles', function ($user) {
                    return $user->roles->pluck('name')->map(function ($role) {
                        return '<span class="badge bg-danger">' . $role . '</span>';
                    })->implode(' ') ?: '<span class="text-muted">No roles</span>';
                })
                ->editColumn('created_at', fn($user) => $user->created_at->format('M d, Y'))
                ->addColumn('action', function ($user) {
                    $show   = '<a href="' . route('admin.users.show', $user->id) . '" class="btn btn-sm btn-outline-info me-1">View</a>';
                    $edit   = '<a href="' . route('admin.users.edit', $user->id) . '" class="btn btn-sm btn-outline-danger me-1">Edit</a>';
                    $delete = '<form method="POST" action="' . route('admin.users.destroy', $user->id) . '" style="display:inline-block;">'
                    . csrf_field()
                    . method_field('DELETE')
                        . '<button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>'
                        . '</form>';
                    return $show . ' ' . $edit . ' ' . $delete;
                })
                ->rawColumns(['avatar', 'roles', 'action'])
                ->make(true);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'roles'    => ['array'],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->has('roles')) {
            $user->assignRole($request->roles);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'roles'    => ['array'],
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        $user->syncRoles($request->roles ?? []);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', 'string', 'exists:roles,name'],
        ]);

        $user->assignRole($request->role);

        return back()->with('success', 'Role assigned successfully.');
    }
}
