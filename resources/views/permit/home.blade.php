@extends('master')

@section('title', 'Admin')

@section('content')
    <div class="min-vh-80">
        <div class="container">
            <a href="/permits/create" class="btn btn-primary mt-3 mb-3">Add Permit</a>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Employee Name</th>
                        <th scope="col" colspan="4"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                            <td colspan="4">
                                @if ($employee->permits->count() > 0)
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Permit Reason</th>
                                                <th scope="col">Start Date</th>
                                                <th scope="col">End Date</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($employee->permits as $permit)
                                                <tr>
                                                    <td>{{ $permit->reason }}</td>
                                                    <td>{{ $permit->start_date }}</td>
                                                    <td>{{ $permit->end_date }}</td>
                                                    <td>
                                                        <a href="/permits/{{ $permit->id }}/edit"><span class="badge bg-primary">Update</span></a>
                                                        <form action="/permits/{{ $permit->id }}" method="POST" style="display: inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="badge bg-danger" onclick="return confirm('Are you sure you want to delete this admin?')">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>No permits found for this employee.</p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
