@extends('layouts.app')

@section('title', 'Team Dashboard — Asylum Made Track & Field')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <h1 class="h3 fw-bold">{{ $team->name }}</h1>
        <p class="text-muted mb-0">Team Dashboard</p>
      </div>
    </div>

    {{-- Stats --}}
    <div class="row g-4 mb-4">
      <div class="col-md-4">
        <div class="card border-0 shadow-sm">
          <div class="card-body text-center py-4">
            <div class="stat-number">{{ $team->drivers->count() }}</div>
            <div class="stat-label">Athletes</div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-0 shadow-sm">
          <div class="card-body text-center py-4">
            <div class="stat-number">0</div>
            <div class="stat-label">Events Registered</div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-0 shadow-sm">
          <div class="card-body text-center py-4">
            <div class="stat-number">0</div>
            <div class="stat-label">Total Points</div>
          </div>
        </div>
      </div>
    </div>

    {{-- Quick Actions --}}
    <div class="row mb-4">
      <div class="col">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h3 class="h5 fw-bold mb-3">Quick Actions</h3>
            <div class="d-flex flex-wrap gap-2">
              <a href="{{ route('team.athletes.create') }}" class="btn btn-primary">+ Add Athlete</a>
              <a href="{{ route('team.edit') }}" class="btn btn-outline-secondary">Edit Team Info</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      {{-- Athletes List --}}
      <div class="col-lg-8 mb-4">
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h3 class="h5 fw-bold mb-0">Athletes</h3>
            <a href="{{ route('team.athletes') }}" class="text-decoration-none small">View All →</a>
          </div>
          <div class="card-body p-0">
            @forelse($team->drivers as $driver)
            <div class="d-flex align-items-center p-3 {{ $loop->last ? '' : 'border-bottom' }}">
              <div class="flex-grow-1">
                <div class="fw-semibold">{{ $driver->name }}</div>
                <div class="text-muted small">{{ $driver->age_division ?? 'No division' }}</div>
              </div>
              @if($driver->is_active)
              <span class="badge bg-success">Active</span>
              @else
              <span class="badge bg-secondary">Inactive</span>
              @endif
            </div>
            @empty
            <div class="p-4 text-center text-muted">
              No athletes yet. <a href="{{ route('team.athletes.create') }}">Add your first athlete</a>.
            </div>
            @endforelse
          </div>
        </div>
      </div>

      {{-- Team Info --}}
      <div class="col-lg-4 mb-4">
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white">
            <h3 class="h5 fw-bold mb-0">Team Info</h3>
          </div>
          <div class="card-body">
            @if($team->city || $team->state)
            <p><strong>Location:</strong> {{ $team->city }}{{ $team->city && $team->state ? ', ' : '' }}{{ $team->state }}</p>
            @endif
            @if($team->contact_name)
            <p><strong>Contact:</strong> {{ $team->contact_name }}</p>
            @endif
            @if($team->contact_email)
            <p><strong>Email:</strong> <a href="mailto:{{ $team->contact_email }}">{{ $team->contact_email }}</a></p>
            @endif
            @if($team->contact_phone)
            <p><strong>Phone:</strong> {{ $team->contact_phone }}</p>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection