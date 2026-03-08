@extends('layouts.app')

@section('title', '{{ $event->name }} — Asylum Made Track')

@section('meta_description')
{{ $event->name }} event details for Asylum Made Track in Riverview, Florida.
@endsection

@section('content')

<section class="py-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('schedule') }}">Schedule</a></li>
            <li class="breadcrumb-item active">{{ $event->name }}</li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div>
                <h1 class="h3 fw-bold mb-1">{{ $event->name }}</h1>
                @if($event->season)
                <p class="text-muted mb-0">{{ $event->season->name }} Season</p>
                @endif
              </div>
              @if($event->status === 'registration_open')
              <span class="badge bg-success fs-6">Registration Open</span>
              @elseif($event->status === 'scheduled')
              <span class="badge bg-primary fs-6">Scheduled</span>
              @elseif($event->status === 'completed')
              <span class="badge bg-secondary fs-6">Completed</span>
              @elseif($event->status === 'cancelled')
              <span class="badge bg-danger fs-6">Cancelled</span>
              @endif
            </div>

            <div class="row g-3 mb-4">
              <div class="col-md-6">
                <div class="d-flex align-items-center">
                  <div class="me-3" style="width: 48px; height: 48px; background-color: var(--surface-soft); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <span>📅</span>
                  </div>
                  <div>
                    <div class="text-muted small">Date</div>
                    <div class="fw-semibold">{{ $event->event_date?->format('F j, Y') ?? 'TBD' }}</div>
                  </div>
                </div>
              </div>
              @if($event->track_condition)
              <div class="col-md-6">
                <div class="d-flex align-items-center">
                  <div class="me-3" style="width: 48px; height: 48px; background-color: var(--surface-soft); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <span>🏁</span>
                  </div>
                  <div>
                    <div class="text-muted small">Track</div>
                    <div class="fw-semibold">{{ $event->track_condition }}</div>
                  </div>
                </div>
              </div>
              @endif
            </div>

            @if($event->gates_open_time || $event->practice_start_time || $event->racing_start_time)
            <div class="mb-4">
              <h2 class="h5 fw-bold mb-3">Schedule</h2>
              <div class="row g-3">
                @if($event->gates_open_time)
                <div class="col-md-4">
                  <div class="p-3 rounded" style="background-color: var(--surface-soft);">
                    <div class="text-muted small">Gates Open</div>
                    <div class="fw-semibold">{{ $event->gates_open_time }}</div>
                  </div>
                </div>
                @endif
                @if($event->practice_start_time)
                <div class="col-md-4">
                  <div class="p-3 rounded" style="background-color: var(--surface-soft);">
                    <div class="text-muted small">Practice</div>
                    <div class="fw-semibold">{{ $event->practice_start_time }}</div>
                  </div>
                </div>
                @endif
                @if($event->racing_start_time)
                <div class="col-md-4">
                  <div class="p-3 rounded" style="background-color: var(--surface-soft);">
                    <div class="text-muted small">Racing Starts</div>
                    <div class="fw-semibold">{{ $event->racing_start_time }}</div>
                  </div>
                </div>
                @endif
              </div>
            </div>
            @endif

            @if($event->special_notes)
            <div class="mb-4">
              <h2 class="h5 fw-bold mb-3">Event Notes</h2>
              <p class="text-muted">{{ $event->special_notes }}</p>
            </div>
            @endif

            @if($event->weather_notes)
            <div class="p-3 rounded mb-4" style="background-color: var(--surface-soft);">
              <div class="d-flex align-items-center">
                <span class="me-2">🌤️</span>
                <div>
                  <div class="text-muted small">Weather</div>
                  <div>{{ $event->weather_notes }}</div>
                </div>
              </div>
            </div>
            @endif
          </div>
        </div>

        {{-- Vehicle Classes --}}
        @if($event->vehicleClasses->count() > 0)
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white">
            <h2 class="h5 fw-bold mb-0">Classes</h2>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table mb-0">
                <thead>
                  <tr>
                    <th>Class</th>
                    <th>Description</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($event->vehicleClasses as $class)
                  <tr>
                    <td class="fw-semibold">{{ $class->name }}</td>
                    <td>{{ $class->description ?? '—' }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        @endif
      </div>

      <div class="col-lg-4">
        {{-- Admission --}}
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white">
            <h2 class="h5 fw-bold mb-0">Admission</h2>
          </div>
          <div class="card-body">
            @if($event->admission_general || $event->admission_pit || $event->admission_kids)
            <ul class="list-unstyled mb-0">
              @if($event->admission_general)
              <li class="d-flex justify-content-between py-2">
                <span>General Admission</span>
                <span class="fw-semibold">${{ number_format($event->admission_general, 2) }}</span>
              </li>
              @endif
              @if($event->admission_pit)
              <li class="d-flex justify-content-between py-2">
                <span>Pit Pass</span>
                <span class="fw-semibold">${{ number_format($event->admission_pit, 2) }}</span>
              </li>
              @endif
              @if($event->admission_kids)
              <li class="d-flex justify-content-between py-2">
                <span>Kids (Under 12)</span>
                <span class="fw-semibold">${{ number_format($event->admission_kids, 2) }}</span>
              </li>
              @endif
            </ul>
            @else
            <p class="text-muted mb-0">Admission prices to be announced.</p>
            @endif
          </div>
        </div>

        {{-- Register CTA --}}
        @if($event->status === 'registration_open')
        <div class="card border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));">
          <div class="card-body text-white text-center py-4">
            <h3 class="h5 fw-bold mb-2">Registration Open</h3>
            <p class="mb-3">Sign up to compete in this event.</p>
            <a href="{{ route('registration') }}" class="btn btn-light">Register Now</a>
          </div>
        </div>
        @endif

        {{-- Location --}}
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white">
            <h2 class="h5 fw-bold mb-0">Location</h2>
          </div>
          <div class="card-body">
            <p class="mb-2">Asylum Made Track</p>
            <p class="text-muted mb-3">Riverview, Florida</p>
            <a href="https://maps.google.com/?q=Riverview,FL" target="_blank" class="btn btn-outline-secondary w-100">
              Get Directions
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection