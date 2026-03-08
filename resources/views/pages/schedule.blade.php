@extends('layouts.app')

@section('title', 'Schedule — Asylum Made Track & Field')

@section('meta_description')
View upcoming track & field meets, events, and practice schedules for Asylum Made Track & Field in Riverview, Florida.
@endsection

@section('content')

<section class="py-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <h1 class="h2 fw-bold mb-2">Meet Schedule</h1>
        <p style="color: var(--muted);">Upcoming events and practice times for the {{ $currentSeason?->year ?? 'current' }} season.</p>
      </div>
    </div>

    @if($events->count() > 0)
      <div class="row g-4">
        @foreach($events as $event)
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                  <h3 class="h5 fw-bold mb-1">{{ $event->name }}</h3>
                  <p class="text-muted small mb-0">{{ $event->location ?? 'Riverview, FL' }}</p>
                </div>
                @if($event->status === 'upcoming')
                <span class="badge" style="background-color: var(--accent-secondary); color: white;">Upcoming</span>
                @elseif($event->status === 'active')
                <span class="badge" style="background-color: var(--accent-primary); color: white;">Active</span>
                @else
                <span class="badge" style="background-color: var(--muted); color: white;">Completed</span>
                @endif
              </div>
              <div class="mb-3">
                <div class="d-flex align-items-center mb-2">
                  <span class="me-2">📅</span>
                  <span>{{ $event->start_date?->format('M j, Y') ?? 'TBD' }}</span>
                </div>
                @if($event->start_time)
                <div class="d-flex align-items-center">
                  <span class="me-2">🕐</span>
                  <span>{{ $event->start_time }}</span>
                </div>
                @endif
              </div>
              @if($event->description)
              <p class="text-muted small">{{ Str::limit($event->description, 100) }}</p>
              @endif
              <a href="{{ route('events.show', $event->id) }}" class="stretched-link"></a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    @else
      <div class="text-center py-5">
        <div class="mb-3" style="font-size: 3rem;">📅</div>
        <h3 class="h5 fw-bold mb-2">No Events Scheduled</h3>
        <p class="text-muted">Check back soon for upcoming meets and events.</p>
      </div>
    @endif

    <div class="mt-5 p-4" style="background-color: var(--surface-soft); border-radius: var(--radius-lg);">
      <h3 class="h5 fw-bold mb-3">Regular Practice Schedule</h3>
      <div class="row g-3">
        <div class="col-md-6">
          <div class="d-flex align-items-center">
            <div class="me-3" style="width: 48px; height: 48px; background-color: var(--accent-primary); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <span style="color: white;">Tue</span>
            </div>
            <div>
              <div class="fw-semibold">Tuesday</div>
              <div class="text-muted small">6:00 PM - 7:30 PM</div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="d-flex align-items-center">
            <div class="me-3" style="width: 48px; height: 48px; background-color: var(--accent-secondary); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <span style="color: white;">Thu</span>
            </div>
            <div>
              <div class="fw-semibold">Thursday</div>
              <div class="text-muted small">6:00 PM - 7:30 PM</div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="d-flex align-items-center">
            <div class="me-3" style="width: 48px; height: 48px; background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary)); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <span style="color: white;">Sat</span>
            </div>
            <div>
              <div class="fw-semibold">Saturday</div>
              <div class="text-muted small">9:00 AM - 11:00 AM</div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="d-flex align-items-center">
            <div class="me-3" style="width: 48px; height: 48px; background-color: var(--muted); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <span style="color: white;">📍</span>
            </div>
            <div>
              <div class="fw-semibold">Location</div>
              <div class="text-muted small">Riverview, Florida</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection