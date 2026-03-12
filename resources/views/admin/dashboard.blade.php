@extends('layouts.admin')

@section('title', 'Admin Dashboard — Asylum Made Track & Field')

@section('admin-content')

<div class="mb-4">
  <h1 class="h3 fw-bold">Admin Dashboard</h1>
  <p class="text-muted">Manage teams, events, and league settings.</p>
</div>

{{-- Stats --}}
<div class="row g-4 mb-4">
  <div class="col-md-3">
    <div class="card border-0 shadow-sm">
      <div class="card-body text-center py-4">
        <div class="stat-number">{{ $stats['teams'] }}</div>
        <div class="stat-label">Teams</div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card border-0 shadow-sm">
      <div class="card-body text-center py-4">
        <div class="stat-number">{{ $stats['athletes'] }}</div>
        <div class="stat-label">Athletes</div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card border-0 shadow-sm">
      <div class="card-body text-center py-4">
        <div class="stat-number">{{ $stats['events'] }}</div>
        <div class="stat-label">Upcoming Events</div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card border-0 shadow-sm">
      <div class="card-body text-center py-4">
        <div class="stat-number">{{ $stats['seasons'] }}</div>
        <div class="stat-label">Active Season</div>
      </div>
    </div>
  </div>
</div>

{{-- Recent Teams & Upcoming Events --}}
<div class="row">
  <div class="col-lg-6 mb-4">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h3 class="h5 fw-bold mb-0">Recent Teams</h3>
        <a href="{{ route('admin.teams.index') }}" class="text-decoration-none small">View All →</a>
      </div>
      <div class="card-body">
        @forelse($recentTeams as $team)
        <div class="d-flex align-items-center py-2 {{ $loop->last ? '' : 'border-bottom' }}">
          <div class="flex-grow-1">
            <div class="fw-semibold">{{ $team->name }}</div>
            <div class="text-muted small">{{ $team->city }}{{ $team->city && $team->state ? ', ' : '' }}{{ $team->state }}</div>
          </div>
          <span class="badge {{ $team->is_active ? 'bg-success' : 'bg-secondary' }}">
            {{ $team->is_active ? 'Active' : 'Inactive' }}
          </span>
        </div>
        @empty
        <p class="text-muted mb-0">No teams yet.</p>
        @endforelse
      </div>
    </div>
  </div>

  <div class="col-lg-6 mb-4">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h3 class="h5 fw-bold mb-0">Upcoming Events</h3>
        <a href="{{ route('admin.events.index') }}" class="text-decoration-none small">View All →</a>
      </div>
      <div class="card-body">
        @forelse($upcomingEvents as $event)
        <div class="d-flex align-items-center py-2 {{ $loop->last ? '' : 'border-bottom' }}">
          <div class="flex-grow-1">
            <div class="fw-semibold">{{ $event->name }}</div>
            <div class="text-muted small">{{ $event->event_date?->format('M j, Y') ?? 'TBD' }}</div>
          </div>
          <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
        </div>
        @empty
        <p class="text-muted mb-0">No upcoming events.</p>
        @endforelse
      </div>
    </div>
  </div>
</div>

@endsection