<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();

        return view('employee.home', compact('employees'));
    }
    
    public function create()
    {
        return view('employee.create');
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'handphone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
        ]);
    
        Employee::create($validatedData);
    
        return redirect('/employees')->with('success', 'Employee added successfully!');
    }
    
    public function show(string $id)
    {
        //
    }
    
    public function edit(string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return redirect('/employees')->with('error', 'Employee not found.');
        }

        return view('employee.update', compact('employee'));
    }
    
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,'.$id,
            'handphone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
        ]);
    
        $employee = Employee::find($id);
    
        if (!$employee) {
            return redirect('/employees')->with('error', 'Employee not found.');
        }
        
        $employee->update($validatedData);
        
        return redirect('/employees')->with('success', 'Employee updated successfully!');
    }

    public function destroy(string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return redirect('/employees')->with('error', 'Employee not found.');
        }

        $employee->delete();

        return redirect('/employees')->with('success', 'Employee deleted successfully!');
    }
}
