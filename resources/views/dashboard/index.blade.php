@extends('layouts.app')

@section('title', 'Dashboard — Asylum Made Track & Field')

@section('content')

<div class="py-4">
  <div class="container">
    {{-- Welcome Header --}}
    <div class="row mb-4">
      <div class="col">
        <h1 class="h3 fw-bold">Welcome, {{ $user->name }}!</h1>
        <p class="text-muted">
          @if($user->isSuperUser())
            <span class="badge bg-danger">Super User</span>
          @elseif($user->isAdmin())
            <span class="badge bg-primary">Administrator</span>
          @elseif($user->role === 'official')
            <span class="badge bg-info">Track Official</span>
          @elseif($user->role === 'team_owner')
            <span class="badge bg-success">Team Owner</span>
          @else
            <span class="badge bg-secondary">Driver</span>
          @endif
        </p>
      </div>
      <div class="col-auto">
        <a href="{{ route('profile.index') }}" class="btn btn-outline-secondary">
          <i class="bi bi-person-gear me-1"></i> Profile Settings
        </a>
      </div>
    </div>

    @if($user->canAccessAdmin())
    {{-- Admin Quick Access --}}
    <div class="row mb-4">
      <div class="col">
        <div class="card border-0 shadow-sm bg-light">
          <div class="card-body">
            <h3 class="h5 fw-bold mb-3"><i class="bi bi-gear me-2"></i>Admin Quick Access</h3>
            <div class="d-flex flex-wrap gap-2">
              <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                <i class="bi bi-speedometer2 me-1"></i> Admin Dashboard
              </a>
              <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-people me-1"></i> Manage Users
              </a>
              <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-calendar-event me-1"></i> Manage Events
              </a>
              <a href="{{ route('admin.teams.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-people-fill me-1"></i> Manage Teams
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif

    <div class="row">
      {{-- Upcoming Events --}}
      <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h3 class="h5 fw-bold mb-0"><i class="bi bi-calendar-event me-2"></i>Upcoming Events</h3>
            <a href="{{ route('schedule') }}" class="text-decoration-none small">View All →</a>
          </div>
          <div class="card-body">
            @forelse($upcomingEvents as $event)
            <div class="d-flex align-items-center py-2 {{ $loop->last ? '' : 'border-bottom' }}">
              <div class="flex-grow-1">
                <div class="fw-semibold">{{ $event->name }}</div>
                <div class="text-muted small">
                  {{ $event->event_date?->format('M j, Y') ?? 'TBD' }}
                  @if($event->status === 'registration_open')
                    <span class="badge bg-success ms-1">Registration Open</span>
                  @endif
                </div>
              </div>
              @if($event->status === 'registration_open')
                <a href="{{ route('registration') }}" class="btn btn-sm btn-primary">Register</a>
              @endif
            </div>
            @empty
            <p class="text-muted mb-0">No upcoming events scheduled.</p>
            @endforelse
          </div>
        </div>
      </div>

      {{-- My Team --}}
      <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-header bg-white">
            <h3 class="h5 fw-bold mb-0"><i class="bi bi-people-fill me-2"></i>My Team</h3>
          </div>
          <div class="card-body">
            @if($myTeam)
              <div class="mb-3">
                <h4 class="h6 fw-bold">{{ $myTeam->name }}</h4>
                <p class="text-muted mb-2">
                  @if($myTeam->city)
                    {{ $myTeam->city }}@if($myTeam->state), {{ $myTeam->state }}@endif
                  @endif
                </p>
                <p class="mb-0">{{ $myTeam->bio }}</p>
              </div>
              <div class="d-flex gap-2">
                <a href="{{ route('team.show', $myTeam->slug) }}" class="btn btn-outline-secondary btn-sm">
                  View Team
                </a>
                <a href="{{ route('team.edit', $myTeam->slug) }}" class="btn btn-outline-secondary btn-sm">
                  Manage Team
                </a>
              </div>
            @elseif($user->isTeamOwner())
              <p class="text-muted">You haven't created a team yet.</p>
              <a href="{{ route('team.create') }}" class="btn btn-primary btn-sm">Create Team</a>
            @else
              <p class="text-muted">Contact your team owner to be added to a team.</p>
            @endif
          </div>
        </div>
      </div>
    </div>

    @if($registrations->count() > 0)
    {{-- My Registrations --}}
    <div class="row">
      <div class="col-12">
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white">
            <h3 class="h5 fw-bold mb-0"><i class="bi bi-card-checklist me-2"></i>My Registrations</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover mb-0">
                <thead>
                  <tr>
                    <th>Event</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($registrations as $registration)
                  <tr>
                    <td>{{ $registration->event->name }}</td>
                    <td>{{ $registration->event->event_date?->format('M j, Y') ?? 'TBD' }}</td>
                    <td>
                      <span class="badge {{ $registration->status === 'confirmed' ? 'bg-success' : 'bg-warning' }}">
                        {{ ucfirst($registration->status) }}
                      </span>
                    </td>
                    <td>
                      <a href="{{ route('registration.confirmation', $registration->id) }}" class="btn btn-sm btn-outline-secondary">
                        View
                      </a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif

    {{-- Quick Links --}}
    <div class="row mt-4">
      <div class="col-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h3 class="h5 fw-bold mb-3">Quick Links</h3>
            <div class="row">
              <div class="col-md-3 mb-2">
                <a href="{{ route('schedule') }}" class="btn btn-outline-secondary w-100">
                  <i class="bi bi-calendar me-2"></i>Event Schedule
                </a>
              </div>
              <div class="col-md-3 mb-2">
                <a href="{{ route('results') }}" class="btn btn-outline-secondary w-100">
                  <i class="bi bi-trophy me-2"></i>Race Results
                </a>
              </div>
              <div class="col-md-3 mb-2">
                <a href="{{ route('standings') }}" class="btn btn-outline-secondary w-100">
                  <i class="bi bi-list-ol me-2"></i>Standings
                </a>
              </div>
              <div class="col-md-3 mb-2">
                <a href="{{ route('rules') }}" class="btn btn-outline-secondary w-100">
                  <i class="bi bi-book me-2"></i>Rules
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection