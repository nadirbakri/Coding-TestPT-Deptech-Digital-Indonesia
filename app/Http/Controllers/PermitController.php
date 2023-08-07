<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Permit;
use Carbon\Carbon;
 
class PermitController extends Controller
{
    public function index()
    {
        $employees = Employee::with('permits')->get();

        return view('permit.home', compact('employees'));
    }
    
    public function create()
    {
        $employees = Employee::all();

        return view('permit.create', compact('employees'));
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'reason' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $employeeId = $validatedData['employee_id'];
        $existingPermits = Permit::where('employee_id', $employeeId)
                                ->whereYear('start_date', Carbon::parse($validatedData['start_date'])->year)
                                ->get();

        $jumlahCuti = 0;

        foreach ($existingPermits as $data) {
            $start_date = Carbon::parse($data->start_date);
            $end_date = Carbon::parse($data->end_date);
            $durationInDays = $end_date->diffInDays($start_date);
            $jumlahCuti += $durationInDays + 1;
        }

        $start_date = Carbon::parse($validatedData['start_date']);
        $end_date = Carbon::parse($validatedData['end_date']);
        $durationInDays = $end_date->diffInDays($start_date);
        $jumlahCuti += $durationInDays + 1;

        if ($jumlahCuti >= 5) {
            $remainingCuti = 5 - $jumlahCuti;
            return redirect()->back()->with('error', 'Employee has already reached the maximum number of permits (Remaining: ' . $remainingCuti . ')');
        }

        Permit::create($validatedData);

        return redirect('/permits')->with('success', 'Permit added successfully!');
    }

    public function show(string $id)
    {
        //
    }
    
    public function edit(string $id)
    {
        $permit = Permit::find($id);
        $employees = Employee::all();

        if (!$permit) {
            return redirect('/permits')->with('error', 'Permit not found.');
        }

        return view('permit.update', compact('permit', 'employees'));    }
    
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'reason' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);
    
        $permit = Permit::find($id);
    
        if (!$permit) {
            return redirect('/permits')->with('error', 'Permit not found.');
        }
        
        $permit->update($validatedData);
        
        return redirect('/permits')->with('success', 'Permit updated successfully!');
    }
    
    public function destroy(string $id)
    {
        $permit = Permit::find($id);

        if (!$permit) {
            return redirect('/permits')->with('error', 'Permit not found.');
        }

        $permit->delete();

        return redirect('/permits')->with('success', 'Permit deleted successfully!');
    }
}
