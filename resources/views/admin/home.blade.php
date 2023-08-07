@extends('master')

@section('title', 'Admin')

@section('content')
    <div class="min-vh-80">
        <div class="container">
            <a href="/admins/create" class="btn btn-primary mt-3 mb-3">Add Admin</a>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $admin->first_name }} {{ $admin->last_name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                <a href="/admins/{{ $admin->id }}/edit"><span class="badge bg-primary">Update</span></a>
                                <form action="/admins/{{ $admin->id }}" method="POST" style="display: inline">
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
