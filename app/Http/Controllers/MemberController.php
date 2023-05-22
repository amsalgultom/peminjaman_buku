<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.members.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.members.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function edit(User $user)
    {
        return view('admin.members.edit', compact('user'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        $data = $request->all();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('members.index')->with('success', 'Member created successfully.');
    }

    
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.members.show', compact('user'));
    }
    
    public function getmembers()
    {
        
        $members = User::where('type', 0)->get();
        return DataTables::of($members)->toJson();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        $user->update($request->all());

        return redirect()->route('members.index')->with('success', 'Member updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // print_r($request);die;
        $user = User::where('id', $request->id)->delete();
        return Response()->json($user);
    }
}
