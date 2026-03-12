@extends('layouts.admin')

@section('title', 'Registrations — Admin')

@section('admin-content')

<div class="mb-4">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 fw-bold">Registrations</h1>
      <p class="text-muted mb-0">Manage event registrations and check-ins.</p>
    </div>
    <div class="d-flex gap-2">
      <a href="{{ route('admin.registrations.export', ['event' => request('event_id')]) }}" class="btn btn-outline-secondary" @unless(request('event_id')) disabled @endunless>
        <i class="bi bi-download me-1"></i> Export CSV
      </a>
    </div>
  </div>
</div>

{{-- Filters --}}
<div class="card border-0 shadow-sm mb-4">
  <div class="card-body">
    <form method="GET" class="row g-3">
      <div class="col-md-3">
        <label for="event_id" class="form-label">Event</label>
        <select id="event_id" name="event_id" class="form-select">
          <option value="">All Events</option>
          @foreach($events as $event)
          <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>
            {{ $event->name }} — {{ $event->event_date?->format('M j, Y') ?? 'TBD' }}
          </option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2">
        <label for="status" class="form-label">Status</label>
        <select id="status" name="status" class="form-select">
          <option value="">All Statuses</option>
          @foreach(App\Models\Registration::getStatuses() as $value => $label)
          <option value="{{ $value }}" {{ request('status') === $value ? 'selected' : '' }}>{{ $label }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-3">
        <label for="search" class="form-label">Search</label>
        <input type="text" id="search" name="search" class="form-control" placeholder="Name or email..." value="{{ request('search') }}">
      </div>
      <div class="col-md-2 d-flex align-items-end">
        <button type="submit" class="btn btn-primary w-100">
          <i class="bi bi-filter me-1"></i> Filter
        </button>
      </div>
      <div class="col-md-2 d-flex align-items-end">
        <a href="{{ route('admin.registrations.index') }}" class="btn btn-outline-secondary w-100">Clear</a>
      </div>
    </form>
  </div>
</div>

{{-- Registrations Table --}}
<div class="card border-0 shadow-sm">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table mb-0">
        <thead>
          <tr>
            <th>Event</th>
            <th>Driver</th>
            <th>Team</th>
            <th>Class</th>
            <th>Car #</th>
            <th>Status</th>
            <th>Paid</th>
            <th>Checked In</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($registrations as $reg)
          <tr>
            <td>
              <a href="{{ route('admin.events.edit', $reg->event_id) }}">{{ $reg->event->name }}</a>
              <br><small class="text-muted">{{ $reg->event->event_date?->format('M j, Y') ?? 'TBD' }}</small>
            </td>
            <td>
              @if($reg->driver)
                <a href="{{ route('admin.drivers.show', $reg->driver_id) }}">{{ $reg->driver->full_name }}</a>
              @else
                <span class="text-muted">Guest</span>
              @endif
            </td>
            <td>
              @if($reg->team)
                <a href="{{ route('admin.teams.show', $reg->team_id) }}">{{ $reg->team->name }}</a>
              @else
                <span class="text-muted">Independent</span>
              @endif
            </td>
            <td>{{ $reg->vehicleClass->name }}</td>
            <td>
              @if($reg->car_number)
                <span class="badge bg-dark fs-6">{{ $reg->car_number }}</span>
              @else
                <span class="text-muted">—</span>
              @endif
            </td>
            <td>
              <span class="badge bg-{{ $reg->status_color }}">{{ $reg->status_label }}</span>
            </td>
            <td>
              @if($reg->paid)
                <span class="badge bg-success">Paid</span>
              @else
                <span class="badge bg-warning text-dark">Unpaid</span>
              @endif
            </td>
            <td>
              @if($reg->checked_in)
                <span class="badge bg-info">Yes</span>
                <br><small class="text-muted">{{ $reg->check_in_time?->format('H:i') }}</small>
              @else
                <span class="badge bg-secondary">No</span>
              @endif
            </td>
            <td class="text-end">
              <a href="{{ route('admin.registrations.edit', $reg) }}" class="btn btn-sm btn-outline-secondary me-1">Edit</a>
              @if($reg->isPending())
                <form action="{{ route('admin.registrations.approve', $reg) }}" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="btn btn-sm btn-success">Approve</button>
                </form>
              @endif
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="9" class="text-center py-4 text-muted">No registrations found.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

{{ $registrations->links() }}

@endsection