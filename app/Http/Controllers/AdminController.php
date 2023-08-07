<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();

        return view('admin.home', compact('admins'));
    }
    
    public function create()
    {
        return view('admin.create');
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8',
        ]);
    
        Admin::create($validatedData);
    
        return redirect('/admins')->with('success', 'Admin added successfully!');
    }
    
    public function show(string $id)
    {
        //
    }
    
    public function edit(string $id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return redirect('/admins')->with('error', 'Admin not found.');
        }

        return view('admin.update', compact('admin'));
    }
    
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
        ]);
    
        $admin = Admin::find($id);
    
        if (!$admin) {
            return redirect('/admins')->with('error', 'Admin not found.');
        }
    
        $admin->update($validatedData);
    
        return redirect('/admins')->with('success', 'Admin updated successfully!');
    }

    public function destroy(string $id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return redirect('/admins')->with('error', 'Admin not found.');
        }

        $admin->delete();

        return redirect('/admins')->with('success', 'Admin updated successfully!');
    }
}
