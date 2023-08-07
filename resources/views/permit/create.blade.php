@extends('master')

@section('title', 'Add Permit')

@section('content')
    <div class="min-vh-80">
        <div class="container">
            <form method="post" action="{{ url('/permits') }}" class="mt-3">
                @csrf
                <div class="mb-3">
                    <label for="employee_id" class="form-label">Employee</label>
                    <select class="form-select" id="employee_id" name="employee_id" required>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                        @endforeach
                    </select>
                    @error('employee_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="reason" class="form-label">Permit Reason</label>
                    <input type="text" class="form-control" id="reason" name="reason" required>
                    @error('reason')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="start_date" class="form-label">Permit Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                    @error('start_date')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="end_date" class="form-label">Permit End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                    @error('end_date')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
