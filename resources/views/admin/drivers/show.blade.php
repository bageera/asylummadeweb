@extends('layouts.app')

@section('title', '{{ $driver->full_name }} — Athlete Details')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.teams.show', $driver->team->id) }}">{{ $driver->team->name }}</a></li>
                <li class="breadcrumb-item active">{{ $driver->full_name }}</li>
              </ol>
            </nav>
            <h1 class="h3 fw-bold">
              @if($driver->nickname)
                "{{ $driver->nickname }}" {{ $driver->last_name }}
              @else
                {{ $driver->full_name }}
              @endif
            </h1>
            @if($driver->hometown)
              <p class="text-muted mb-0"><i class="bi bi-geo-alt me-1"></i>{{ $driver->hometown }}</p>
            @endif
          </div>
          <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn btn-primary">Edit Athlete</a>
        </div>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
          <div class="card-body text-center">
            @if($driver->profile_photo_path)
              <img src="{{ asset('storage/' . $driver->profile_photo_path) }}" alt="{{ $driver->full_name }}" class="img-thumbnail mb-3" style="max-height: 200px;">
            @else
              <div class="bg-secondary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 150px; height: 150px; font-size: 4rem;">
                {{ Str::substr($driver->first_name, 0, 1) }}{{ Str::substr($driver->last_name, 0, 1) }}
              </div>
            @endif
            <h2 class="h4 mb-1">{{ $driver->full_name }}</h2>
            @if($driver->nickname)
              <p class="text-muted">"{{ $driver->nickname }}"</p>
            @endif
            <span class="badge {{ $driver->is_active ? 'bg-success' : 'bg-secondary' }}">
              {{ $driver->is_active ? 'Active' : 'Inactive' }}
            </span>
            @if($driver->user)
              <div class="mt-3">
                <small class="text-muted">Linked to: {{ $driver->user->name }} ({{ $driver->user->email }})</small>
              </div>
            @endif
          </div>
        </div>

        <div class="card border-0 shadow-sm mt-3">
          <div class="card-header bg-white">
            <h3 class="h6 fw-bold mb-0">License & Medical</h3>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <div class="d-flex justify-content-between">
                <span class="text-muted">License</span>
                @if($driver->license_number)
                  <span>{{ $driver->license_number }}</span>
                @else
                  <span class="text-muted">Not set</span>
                @endif
              </div>
              @if($driver->license_expires)
                <div class="mt-1">
                  @if($driver->license_valid)
                    <span class="badge bg-success">Valid until {{ $driver->license_expires->format('M j, Y') }}</span>
                  @else
                    <span class="badge bg-danger">Expired {{ $driver->license_expires->format('M j, Y') }}</span>
                  @endif
                </div>
              @endif
            </div>
            <div>
              <div class="d-flex justify-content-between">
                <span class="text-muted">Medical</span>
                @if($driver->medical_expires)
                  @if($driver->medical_valid)
                    <span class="badge bg-success">Valid until {{ $driver->medical_expires->format('M j, Y') }}</span>
                  @else
                    <span class="badge bg-danger">Expired {{ $driver->medical_expires->format('M j, Y') }}</span>
                  @endif
                @else
                  <span class="text-muted">Not set</span>
                @endif
              </div>
            </div>
          </div>
        </div>

        @if($driver->bio)
        <div class="card border-0 shadow-sm mt-3">
          <div class="card-header bg-white">
            <h3 class="h6 fw-bold mb-0">Biography</h3>
          </div>
          <div class="card-body">
            <p class="mb-0">{{ $driver->bio }}</p>
          </div>
        </div>
        @endif
      </div>

      <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white">
            <h3 class="h6 fw-bold mb-0">Team</h3>
          </div>
          <div class="card-body">
            @if($driver->team)
              <a href="{{ route('admin.teams.show', $driver->team->id) }}" class="d-flex align-items-center">
                <div>
                  <div class="fw-semibold">{{ $driver->team->name }}</div>
                  @if($driver->team->city || $driver->team->state)
                    <small class="text-muted">{{ $driver->team->city }}{{ $driver->team->city && $driver->team->state ? ', ' : '' }}{{ $driver->team->state }}</small>
                  @endif
                </div>
              </a>
            @else
              <span class="text-muted">No team assigned</span>
            @endif
          </div>
        </div>

        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h3 class="h6 fw-bold mb-0">Recent Registrations</h3>
            <span class="badge bg-primary">{{ $driver->registrations->count() }}</span>
          </div>
          <div class="card-body p-0">
            @if($driver->registrations->count() > 0)
              <div class="table-responsive">
                <table class="table mb-0">
                  <thead>
                    <tr>
                      <th>Event</th>
                      <th>Date</th>
                      <th>Class</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($driver->registrations->take(10) as $reg)
                      <tr>
                        <td>{{ $reg->event->name ?? 'Unknown' }}</td>
                        <td>{{ $reg->event->event_date?->format('M j, Y') ?? 'TBD' }}</td>
                        <td>{{ $reg->vehicleClass->name ?? '—' }}</td>
                        <td>
                          <span class="badge {{ $reg->status === 'confirmed' ? 'bg-success' : 'bg-warning' }}">
                            {{ ucfirst($reg->status) }}
                          </span>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <div class="p-4 text-center text-muted">No registrations yet.</div>
            @endif
          </div>
        </div>

        <div class="card border-0 shadow-sm mt-4">
          <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h3 class="h6 fw-bold mb-0">Recent Results</h3>
            <span class="badge bg-primary">{{ $driver->results->count() }}</span>
          </div>
          <div class="card-body p-0">
            @if($driver->results->count() > 0)
              <div class="table-responsive">
                <table class="table mb-0">
                  <thead>
                    <tr>
                      <th>Event</th>
                      <th>Class</th>
                      <th>Position</th>
                      <th>Points</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($driver->results->take(10) as $result)
                      <tr>
                        <td>{{ $result->event->name ?? 'Unknown' }}</td>
                        <td>{{ $result->vehicleClass->name ?? '—' }}</td>
                        <td>{{ $result->position ?? '—' }}</td>
                        <td>{{ $result->points ?? 0 }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <div class="p-4 text-center text-muted">No results yet.</div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection