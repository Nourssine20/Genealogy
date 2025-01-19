@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="display-5 fw-bold">Create Person</h1>
            <p class="text-muted">Please fill in the details below to create a new person.</p>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="h5 mb-0">Person Details</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('people.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name:</label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" class="form-control" placeholder="Enter first name">
                        @error('first_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="middle_names" class="form-label">Middle Names:</label>
                        <input type="text" id="middle_names" name="middle_names" value="{{ old('middle_names') }}" class="form-control" placeholder="Enter middle names">
                        @error('middle_names')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name:</label>
                        <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" class="form-control" placeholder="Enter last name">
                        @error('last_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="birth_name" class="form-label">Birth Name:</label>
                        <input type="text" id="birth_name" name="birth_name" value="{{ old('birth_name') }}" class="form-control" placeholder="Enter birth name">
                        @error('birth_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">Date of Birth (YYYY-MM-DD):</label>
                        <input type="text" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control" placeholder="Enter date of birth">
                        @error('date_of_birth')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
