@extends('layouts.app')

@section('title', 'Admin Dashboard — Asylum Made Track & Field')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <h1 class="h3 fw-bold">Admin Dashboard</h1>
        <p class="text-muted">Manage teams, events, and league settings.</p>
      </div>
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

    {{-- Management Cards --}}
    <div class="row mb-4">
      <div class="col-12">
        <h3 class="h5 fw-bold mb-3">League Management</h3>
      </div>
      
      {{-- Events & Schedule --}}
      <div class="col-md-6 col-lg-3 mb-3">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <h4 class="h6 fw-bold text-primary"><i class="bi bi-calendar-event me-2"></i>Events & Schedule</h4>
            <p class="text-muted small mb-3">Manage races, practice sessions, and event details.</p>
            <div class="d-flex flex-wrap gap-1">
              <a href="{{ route('admin.events.index') }}" class="btn btn-sm btn-outline-primary">All Events</a>
              <a href="{{ route('admin.events.create') }}" class="btn btn-sm btn-primary">+ Add Event</a>
            </div>
          </div>
        </div>
      </div>
      
      {{-- Seasons --}}
      <div class="col-md-6 col-lg-3 mb-3">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <h4 class="h6 fw-bold text-secondary"><i class="bi bi-calendar3 me-2"></i>Seasons</h4>
            <p class="text-muted small mb-3">Manage racing seasons and yearly schedules.</p>
            <div class="d-flex flex-wrap gap-1">
              <a href="{{ route('admin.seasons.index') }}" class="btn btn-sm btn-outline-secondary">All Seasons</a>
              <a href="{{ route('admin.seasons.create') }}" class="btn btn-sm btn-secondary">+ Add Season</a>
            </div>
          </div>
        </div>
      </div>
      
      {{-- Teams --}}
      <div class="col-md-6 col-lg-3 mb-3">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <h4 class="h6 fw-bold text-success"><i class="bi bi-people-fill me-2"></i>Teams</h4>
            <p class="text-muted small mb-3">Manage team profiles, rosters, and registrations.</p>
            <div class="d-flex flex-wrap gap-1">
              <a href="{{ route('admin.teams.index') }}" class="btn btn-sm btn-outline-success">All Teams</a>
              <a href="{{ route('admin.teams.create') }}" class="btn btn-sm btn-success">+ Add Team</a>
            </div>
          </div>
        </div>
      </div>
      
      {{-- Users --}}
      <div class="col-md-6 col-lg-3 mb-3">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <h4 class="h6 fw-bold text-info"><i class="bi bi-person-gear me-2"></i>Users</h4>
            <p class="text-muted small mb-3">Manage user accounts, roles, and permissions.</p>
            <div class="d-flex flex-wrap gap-1">
              <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-info">All Users</a>
              <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-info">+ Add User</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Sponsor & Waiver Management --}}
    <div class="row mb-4">
      <div class="col-12">
        <h3 class="h5 fw-bold mb-3">Business Operations</h3>
      </div>
      
      {{-- Sponsors --}}
      <div class="col-md-6 mb-3">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <div class="me-3">
                <span class="badge bg-warning text-dark fs-5"><i class="bi bi-star-fill"></i></span>
              </div>
              <div>
                <h4 class="h6 fw-bold mb-0">Sponsors</h4>
                <small class="text-muted">Manage sponsorships by tier (Bronze/Silver/Gold/Platinum)</small>
              </div>
            </div>
            <p class="text-muted small mb-3">Track event sponsors, manage logos and sponsorship levels.</p>
            <div class="d-flex flex-wrap gap-2">
              <a href="{{ route('admin.sponsors.index') }}" class="btn btn-outline-warning">
                <i class="bi bi-list me-1"></i> All Sponsors
              </a>
              <a href="{{ route('admin.sponsors.create') }}" class="btn btn-warning">
                <i class="bi bi-plus me-1"></i> Add Sponsor
              </a>
            </div>
          </div>
        </div>
      </div>
      
      {{-- Waivers --}}
      <div class="col-md-6 mb-3">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <div class="me-3">
                <span class="badge bg-danger fs-5"><i class="bi bi-file-earmark-text"></i></span>
              </div>
              <div>
                <h4 class="h6 fw-bold mb-0">Waiver Management</h4>
                <small class="text-muted">Liability waivers, consent forms, signatures</small>
              </div>
            </div>
            <p class="text-muted small mb-3">Create waiver templates, track signed waivers, export for events.</p>
            <div class="d-flex flex-wrap gap-2">
              <a href="{{ route('admin.waivers.index') }}" class="btn btn-outline-danger">
                <i class="bi bi-list me-1"></i> Waiver Templates
              </a>
              <a href="{{ route('admin.waivers.create') }}" class="btn btn-danger">
                <i class="bi bi-plus me-1"></i> Add Template
              </a>
            </div>
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
              <a href="{{ route('admin.teams.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus me-1"></i> Add Team
              </a>
              <a href="{{ route('admin.events.create') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-plus me-1"></i> Add Event
              </a>
              <a href="{{ route('admin.users.create') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-person-plus me-1"></i> Add User
              </a>
              <a href="{{ route('admin.sponsors.create') }}" class="btn btn-outline-warning btn-sm">
                <i class="bi bi-star me-1"></i> Add Sponsor
              </a>
              <a href="{{ route('admin.waivers.create') }}" class="btn btn-outline-danger btn-sm">
                <i class="bi bi-file-earmark-plus me-1"></i> Add Waiver
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      {{-- Recent Teams --}}
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

      {{-- Upcoming Events --}}
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
  </div>
</div>

@endsection