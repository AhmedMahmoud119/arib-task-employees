<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::when($request->input('name'), function ($query, $search) {
            return $query->searchByFullName($search);
        })->when($request->input('email'), function ($query, $search) {
            return $query->where('email',$search);
        })->paginate(10);
        $departments = Department::orderBy('id', 'desc')->get();

        return view('user.index', compact('users','departments'));
    }

    public function create()
    {
        $employees = User::orderBy('id', 'desc')->get();
        $departments = Department::orderBy('id', 'desc')->get();
        return view('user.create', compact('employees', 'departments'));
    }

    public function store(UserRequest $request)
    {
        $image = isset($request->image) ? $request->image : null;

        if ($image) {
            $imageName = time() . uniqid() . '.' . $image->extension();
            $image->storeAs('public/images', $imageName);
        } else {
            $imageName = null;
        }


        User::create($request->except('image') + ['image' => $imageName]);

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        $employees = User::orderBy('id', 'desc')->get();
        $departments = Department::orderBy('id', 'desc')->get();

        return view('user.edit', compact('user','employees','departments'));
    }


    public function update(User $user, UserRequest $request)
    {
        $image = isset($request->image) ? $request->image : null;

        if ($image) {
            $imageName = time() . uniqid() . '.' . $image->extension();
            $image->storeAs('public/images', $imageName);
        } else {
            $imageName = $user->image;
        }

        $user->update($request->all() + ['image' => $imageName]);

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        if ($user->employees->isNotEmpty()) {
            return redirect()->route('users.index')->with([
                'error' => 'Cant Delet This manager has many employees'
            ]);
        }

        $user->delete();

        return back();
    }
}
