<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:users_read'])->only('index');
        $this->middleware(['permission:users_create'])->only(['create', 'store']);
        $this->middleware(['permission:users_delete'])->only(['destroy']);
        $this->middleware(['permission:users_update'])->only(['update', 'edit']);
    }

    public function index(Request $request)
    {
        $users = User::whereRoleIs('admin')->where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(25);

        return view('Dashboard.Users.index', compact('users'));
    }

    public function create()
    {
        return view('Dashboard.Users.create');
    }
    public function store(Request $request)
    {
        //return $request->all();
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
            'permission' => 'required',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->attachRole('admin');
        $user->syncPermissions($request->permission);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'permission' => $request->permission
        ];
        \Mail::to($request->email)->send(new \App\Mail\createUser($data));

        event(new Registered($user));

        if ($user) {
            session()->flash('success', _('site.added_success'));
        }
        return redirect()->route('dashboard.users.index');
    }

    public function edit(User $user)
    {
        return view('Dashboard.Users.edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => ["required", Rule::unique('users')->ignore($user->id)],
            'permission' => 'required',
        ]);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $user->syncPermissions($request->permission);
        if ($user) {
            session()->flash('success', __('site.updated_success'));
        }
        return redirect()->route('dashboard.users.index');
    }
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', __('site.deleted_success'));
        return redirect()->route('dashboard.users.index');
    }
}
