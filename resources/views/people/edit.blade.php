<!-- resources/views/people/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edit Person</h1>

    <form action="{{ route('people.update', $person->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $person->first_name) }}">
            @error('first_name')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="middle_names">Middle Names:</label>
            <input type="text" id="middle_names" name="middle_names" value="{{ old('middle_names', $person->middle_names) }}">
            @error('middle_names')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $person->last_name) }}">
            @error('last_name')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="birth_name">Birth Name:</label>
            <input type="text" id="birth_name" name="birth_name" value="{{ old('birth_name', $person->birth_name) }}">
            @error('birth_name')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="date_of_birth">Date of Birth (YYYY-MM-DD):</label>
            <input type="text" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $person->date_of_birth) }}">
            @error('date_of_birth')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="children">Select Children:</label>
            <select id="children" name="children[]" multiple>
                @foreach($people as $child)
                    <option value="{{ $child->id }}" {{ $person->children->contains($child) ? 'selected' : '' }}>
                        {{ ucfirst(strtolower($child->first_name)) }} {{ strtoupper($child->last_name) }}
                    </option>
                @endforeach
            </select>
            @error('children')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Update</button>
    </form>
@endsection
