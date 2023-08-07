@extends('master')

@section('title', 'Admin')

@section('content')
    <div class="min-vh-80">
        <div class="container">
            <a href="/employees/create" class="btn btn-primary mt-3 mb-3">Add Employee</a>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">HP</th>
                        <th scope="col">Address</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->handphone }}</td>
                            <td>{{ $employee->address }}</td>
                            <td>{{ $employee->gender }}</td>
                            <td>
                                <a href="/employees/{{ $employee->id }}/edit"><span class="badge bg-primary">Update</span></a>
                                <form action="/employees/{{ $employee->id }}" method="POST" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="badge bg-danger" onclick="return confirm('Are you sure you want to delete this admin?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
