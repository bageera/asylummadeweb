@extends('layouts.app')

@section('title', 'Schedule & Results — Asylum Made Track')

@section('meta_description')
Season schedule and race results for the Asylum Made Track local league in Riverview, Florida.
@endsection

@section('content')

{{-- Page Header --}}
<section class="py-5 border-bottom">
  <div class="container">
    <h1 class="h3 fw-semibold mb-3">Schedule & Results</h1>
    <p class="text-muted max-w-lg">
      This page lists scheduled events and published results for the current season.
      Updates are posted as events are completed.
    </p>
  </div>
</section>

{{-- Season Selector (static for now) --}}
<section class="py-4 bg-light border-bottom">
  <div class="container d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
    <strong class="small">Season</strong>
    <div class="btn-group" role="group" aria-label="Season selector">
      <button class="btn btn-sm btn-dark" disabled>2025</button>
      <button class="btn btn-sm btn-outline-secondary" disabled>2024</button>
    </div>
  </div>
</section>

{{-- Schedule Table --}}
<section class="py-5">
  <div class="container">

    <h2 class="h5 fw-semibold mb-3">Event schedule</h2>

    <div class="table-responsive">
      <table class="table align-middle">
        <thead class="table-light">
          <tr>
            <th>Date</th>
            <th>Event</th>
            <th>Location</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>

          @foreach ([
            [
              'date' => 'March 15, 2025',
              'event' => 'Season Opener',
              'location' => 'Riverview Track',
              'status' => 'Completed'
            ],
            [
              'date' => 'April 12, 2025',
              'event' => 'Spring Points Race',
              'location' => 'Riverview Track',
              'status' => 'Completed'
            ],
            [
              'date' => 'May 10, 2025',
              'event' => 'Mid-Season Meet',
              'location' => 'Riverview Track',
              'status' => 'Scheduled'
            ],
            [
              'date' => 'June 14, 2025',
              'event' => 'Summer Series',
              'location' => 'Riverview Track',
              'status' => 'Scheduled'
            ]
          ] as $race)

          <tr>
            <td>{{ $race['date'] }}</td>
            <td>{{ $race['event'] }}</td>
            <td>{{ $race['location'] }}</td>
            <td>
              @if ($race['status'] === 'Completed')
                <span class="badge bg-success-subtle text-success">Completed</span>
              @else
                <span class="badge bg-secondary-subtle text-secondary">Scheduled</span>
              @endif
            </td>
          </tr>

          @endforeach

        </tbody>
      </table>
    </div>

  </div>
</section>

{{-- Results Summary --}}
<section class="py-5 bg-light border-top">
  <div class="container">

    <h2 class="h5 fw-semibold mb-3">Recent results</h2>

    <div class="row g-4">

      @foreach ([
        [
          'event' => 'Season Opener',
          'date' => 'March 15, 2025',
          'note' => 'Results finalized and published.'
        ],
        [
          'event' => 'Spring Points Race',
          'date' => 'April 12, 2025',
          'note' => 'Points standings updated.'
        ]
      ] as $result)

      <div class="col-md-6">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <h3 class="h6 fw-semibold mb-1">{{ $result['event'] }}</h3>
            <p class="small text-muted mb-2">{{ $result['date'] }}</p>
            <p class="text-muted small mb-0">{{ $result['note'] }}</p>
          </div>
        </div>
      </div>

      @endforeach

    </div>

  </div>
</section>

{{-- Callout --}}
<section class="py-5 border-top">
  <div class="container d-flex flex-column flex-lg-row justify-content-between align-items-center gap-3">
    <div>
      <h3 class="h5 fw-semibold mb-1">Looking for event details or class results?</h3>
      <p class="text-muted mb-0">
        Contact the league if you need clarification or additional information.
      </p>
    </div>
    <a href="/contact" class="btn btn-dark px-4">Contact the league</a>
  </div>
</section>

@endsection
