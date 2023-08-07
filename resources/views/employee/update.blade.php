@extends('master')

@section('title', 'Update Employee')

@section('content')
    <div class="min-vh-80">
        <div class="container">
            <form method="post" action="{{ url('/admins/'.$employee->id) }}" class="mt-3">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required value="{{ $employee->first_name }}">
                    @error('first_name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required value="{{ $employee->last_name }}">
                    @error('last_name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required value="{{ $employee->email }}">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="handphone" class="form-label">Handphone</label>
                    <input type="text" class="form-control" id="handphone" name="handphone" required value="{{ $employee->handphone }}">
                    @error('handphone')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required value="{{ $employee->address }}">
                    @error('address')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" id="gender" name="gender" required>
                        <option value="male" {{ $employee->gender === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $employee->gender === 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
