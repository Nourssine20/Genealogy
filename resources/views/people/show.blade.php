<!-- resources/views/people/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h1 class="h3 mb-0" style="color: red;">{{ $person->first_name }} {{ $person->last_name }}</h1>
        </div>
        <div class="card-body">
            <p><strong>Date of Birth:</strong> {{ $person->date_of_birth ?? 'N/A' }}</p>
            <p><strong>Created By:</strong> {{ $person->creator->name ?? 'Unknown' }}</p>
        </div>
    </div>

    <div class="mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h2 class="h5 mb-0" style="color: red;">Children</h2>
            </div>
            <div class="card-body">
                @if ($person->children->isEmpty())
                    <p class="text-muted">No children recorded.</p>
                @else
                    <ul class="list-group">
                        @foreach ($person->children as $child)
                            <li class="list-group-item">
                                <i class="bi bi-person-fill me-2"></i>{{ $child->first_name }} {{ $child->last_name }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <h2 class="h5 mb-0" style="color: red;">Parents</h2>
            </div>
            <div class="card-body">
                @if ($person->parents->isEmpty())
                    <p class="text-muted">No parents recorded.</p>
                @else
                    <ul class="list-group">
                        @foreach ($person->parents as $parent)
                            <li class="list-group-item">
                                <i class="bi bi-person-fill me-2"></i>{{ $parent->first_name }} {{ $parent->last_name }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
