@extends('master')

@section('title', 'Update Admin')

@section('content')
    <div class="min-vh-80">
        <div class="container">
            <form method="post" action="{{ url('/admins/'.$admin->id) }}" class="mt-3">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required value="{{ $admin->first_name }}">
                    @error('first_name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required value="{{ $admin->last_name }}">
                    @error('last_name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
