@extends('layouts.admin')

@section('title', 'Registrations — Admin')

@section('admin-content')

<div class="mb-4">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 fw-bold">Event Registrations</h1>
      <p class="text-muted mb-0">Manage athlete registrations and check-ins for track & field events.</p>
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
        <label for="class_id" class="form-label">Event Class</label>
        <select id="class_id" name="class_id" class="form-select">
          <option value="">All Classes</option>
          @foreach($classes as $class)
          <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
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
        <label for="search" class="form-label">Search Athlete</label>
        <input type="text" id="search" name="search" class="form-control" placeholder="Name or email..." value="{{ request('search') }}">
      </div>
      <div class="col-md-2 d-flex align-items-end gap-2">
        <button type="submit" class="btn btn-primary flex-grow-1">
          <i class="bi bi-filter me-1"></i> Filter
        </button>
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
            <th>Bib #</th>
            <th>Athlete</th>
            <th>Team</th>
            <th>Event</th>
            <th>Class</th>
            <th>Seed</th>
            <th>Status</th>
            <th>Paid</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($registrations as $reg)
          <tr>
            <td>
              @if($reg->bib_number)
                <span class="badge bg-dark fs-6">{{ $reg->bib_number }}</span>
              @else
                <span class="text-muted">—</span>
              @endif
            </td>
            <td>
              @if($reg->athlete)
                <a href="{{ route('admin.drivers.show', $reg->athlete_id) }}">{{ $reg->athlete->full_name }}</a>
              @else
                {{ $reg->first_name }} {{ $reg->last_name }}
                <br><small class="text-muted">{{ $reg->email }}</small>
              @endif
            </td>
            <td>
              @if($reg->team)
                <a href="{{ route('admin.teams.show', $reg->team_id) }}">{{ $reg->team->name }}</a>
              @else
                <span class="text-muted">Unattached</span>
              @endif
            </td>
            <td>
              <a href="{{ route('admin.events.edit', $reg->event_id) }}">{{ $reg->event->name }}</a>
            </td>
            <td>{{ $reg->eventClass->name }}</td>
            <td>
              @if($reg->seed_time || $reg->seed_distance || $reg->seed_mark)
                <span class="font-monospace">{{ $reg->seed_display }}</span>
              @else
                <span class="text-muted">NT</span>
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