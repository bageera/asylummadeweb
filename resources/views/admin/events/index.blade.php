@extends('layouts.app')

@section('title', 'Manage Events — Admin')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h1 class="h3 fw-bold">Events</h1>
            <p class="text-muted mb-0">Manage races, schedules, and event settings.</p>
          </div>
          <a href="{{ route('admin.events.create') }}" class="btn btn-primary">+ Add Event</a>
        </div>
      </div>
    </div>

    <div class="card border-0 shadow-sm">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table mb-0">
            <thead>
              <tr>
                <th>Event</th>
                <th>Date</th>
                <th>Season</th>
                <th>Status</th>
                <th>Classes</th>
                <th class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($events as $event)
              <tr>
                <td>
                  <a href="{{ route('admin.events.edit', $event->id) }}" class="fw-semibold">{{ $event->name }}</a>
                </td>
                <td>{{ $event->event_date?->format('M j, Y') ?? 'TBD' }}</td>
                <td>{{ $event->season?->name ?? '—' }}</td>
                <td>
                  @if($event->status === 'registration_open')
                  <span class="badge bg-success">Registration Open</span>
                  @elseif($event->status === 'scheduled')
                  <span class="badge bg-primary">Scheduled</span>
                  @elseif($event->status === 'completed')
                  <span class="badge bg-secondary">Completed</span>
                  @elseif($event->status === 'cancelled')
                  <span class="badge bg-danger">Cancelled</span>
                  @else
                  <span class="badge bg-secondary">{{ $event->status }}</span>
                  @endif
                </td>
                <td>{{ $event->vehicleClasses->count() }}</td>
                <td class="text-end">
                  <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-outline-secondary me-1">Edit</a>
                  <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this event?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                  </form>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center py-4 text-muted">No events yet. <a href="{{ route('admin.events.create') }}">Add the first event</a>.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{ $events->links() }}
  </div>
</div>

@endsection