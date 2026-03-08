@extends('layouts.app')

@section('title', 'Registration Confirmed — Asylum Made Track')

@section('content')

<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm text-center">
          <div class="card-body py-5">
            <div class="mb-4" style="font-size: 4rem;">✓</div>
            <h1 class="h3 fw-bold mb-3">Registration Submitted</h1>
            <p class="text-muted mb-4">
              Thank you for registering, {{ $registration->first_name }}! Your registration for
              <strong>{{ $registration->event->name }}</strong> has been received.
            </p>

            <div class="row g-3 justify-content-center mb-4">
              <div class="col-md-4">
                <div class="p-3 rounded" style="background-color: var(--surface-soft);">
                  <div class="text-muted small">Event</div>
                  <div class="fw-semibold">{{ $registration->event->name }}</div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="p-3 rounded" style="background-color: var(--surface-soft);">
                  <div class="text-muted small">Date</div>
                  <div class="fw-semibold">{{ $registration->event->event_date?->format('M j, Y') ?? 'TBD' }}</div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="p-3 rounded" style="background-color: var(--surface-soft);">
                  <div class="text-muted small">Class</div>
                  <div class="fw-semibold">{{ $registration->vehicleClass->name }}</div>
                </div>
              </div>
            </div>

            <div class="alert alert-info text-start mb-4">
              <strong>What's Next?</strong>
              <ul class="mb-0 mt-2">
                <li>You will receive a confirmation email at {{ $registration->email }}</li>
                <li>League officials will review your registration</li>
                <li>If approved, you will receive event-specific instructions</li>
                <li>Bring valid ID and safety equipment on race day</li>
              </ul>
            </div>

            <div class="d-flex gap-2 justify-content-center">
              <a href="{{ route('schedule') }}" class="btn btn-outline-secondary">View Schedule</a>
              <a href="{{ route('home') }}" class="btn btn-primary">Return Home</a>
            </div>
          </div>
        </div>

        <div class="card border-0 shadow-sm mt-4">
          <div class="card-body">
            <h2 class="h5 fw-bold mb-3">Registration Summary</h2>
            <div class="row g-3">
              <div class="col-md-6">
                <div class="text-muted small">Participant</div>
                <div>{{ $registration->first_name }} {{ $registration->last_name }}</div>
              </div>
              <div class="col-md-6">
                <div class="text-muted small">Email</div>
                <div>{{ $registration->email }}</div>
              </div>
              <div class="col-md-6">
                <div class="text-muted small">Phone</div>
                <div>{{ $registration->phone }}</div>
              </div>
              @if($registration->team)
              <div class="col-md-6">
                <div class="text-muted small">Team</div>
                <div>{{ $registration->team->name }}</div>
              </div>
              @endif
              <div class="col-md-6">
                <div class="text-muted small">Status</div>
                <div>
                  <span class="badge bg-warning">Pending Review</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection