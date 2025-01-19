@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold">People List</h1>
        <p class="text-muted">A comprehensive list of all registered people.</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="h5 mb-0" style="color: red;">People Overview</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="width: 5%;">ID</th>
                            <th scope="col" style="width: 20%;">First Name</th>
                            <th scope="col" style="width: 20%;">Last Name</th>
                            <th scope="col" style="width: 40%;">Full Name</th>
                            <th scope="col" style="width: 15%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($people as $person)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ ucfirst(strtolower($person->first_name)) }}</td>
                                <td>{{ strtoupper($person->last_name) }}</td>
                                <td class="fw-bold">
                                    {{ ucfirst(strtolower($person->first_name)) }} {{ strtoupper($person->last_name) }}
                                </td>
                                <td class="text-center">
                                    <!-- View button with color -->
                                    <a href="{{ route('people.show', $person->id) }}" class="btn btn-success btn-sm">
                                        <i class="bi bi-eye"></i> View
                                    </a>

                                    <!-- Edit button with color -->
                                    <a href="{{ route('people.edit', $person->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No people found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
