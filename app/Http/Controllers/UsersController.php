<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $users = User::when($request->role, function ($query, $role){
            $query->where('role', $role);
        })->paginate(10);

        return view('admin.users.index', [
            'users' => $users,
            'filters' => [
                'role' => $request->role ? User::ROLE[$request->role] : 'All Users'
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'days' => ['required', 'numeric', 'min:0', 'max:100'],
            'sick_days' => ['required', 'numeric', 'min:0', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['confirmed', Rules\Password::defaults()],
            'role' => ['required', Rule::in(array_keys(User::ROLE))]
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'days' => $request->days,
            'sick_days' => $request->sick_days,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => (int)$request->role
        ]);

        Period::create(['user_id' => $user->id, 'days' => $user->days, 'sick_days' => $user->sick_days, 'year' => date('Y')]);

        return redirect()->route('users.index');

    }

    /*
     * Create next year-period for each user
     *
     * */
    public function createYear(){

        foreach (User::all() as $user) {

            $nextYear = $user->periods->count() ? $user->periods->last()->year + 1 : date('Y');
            if($nextYear - date('Y') > 1) {
                continue;
            }

            $user->periods->count() ? $user->periods->last()->delete() : null;

            Period::create([
                'user_id' => $user->id,
                'days' => $user->periods->count() ? $user->periods->last()->days + $user->days : $user->days,
                'year' => $user->periods->count() ? $nextYear : date('Y')
            ]);

        }

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     */
    public function show(User $user)
    {
        return view('admin.users.show', [
            'user' => $user,
            'daysTakenThisYear' => array_sum($user->applications->where('status', 'approved')->pluck('days')->toArray())
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
            'daysTakenThisYear' => array_sum($user->applications->where('status', 'approved')->pluck('days')->toArray())
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  \App\Models\User  $user
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'days' => ['required', 'numeric', 'min:0', 'max:100'],
            'sick_days' => ['required', 'numeric', 'min:0', 'max:100'],
            'email' => 'unique:users,email,'.$user->id,
            'role' => ['required', Rule::in(array_keys(User::ROLE))]
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'days' => $request->days,
            'sick_days' => $request->sick_days,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => (int)$request->role
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
