@extends('layouts.app')

@section('title', 'Results — Asylum Made Track & Field')

@section('meta_description')
View meet results and performance times for Asylum Made Track & Field athletes.
@endsection

@section('content')

<section class="py-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <h1 class="h2 fw-bold mb-2">Meet Results</h1>
        <p style="color: var(--muted);">Performance results from recent meets and competitions.</p>
      </div>
    </div>

    @if($results->count() > 0)
      @foreach($results->groupBy('event_id') as $eventId => $eventResults)
      <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-white">
          <h3 class="h5 fw-bold mb-0">{{ $eventResults->first()->event?->name ?? 'Event' }}</h3>
          <p class="text-muted small mb-0">{{ $eventResults->first()->event?->start_date?->format('F j, Y') }}</p>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table mb-0">
              <thead>
                <tr>
                  <th>Place</th>
                  <th>Athlete</th>
                  <th>Event</th>
                  <th>Time/Mark</th>
                  <th>Points</th>
                </tr>
              </thead>
              <tbody>
                @foreach($eventResults as $result)
                <tr>
                  <td><strong>{{ $result->finish_position }}</strong></td>
                  <td>{{ $result->driver?->name ?? '—' }}</td>
                  <td>{{ $result->vehicleClass?->name ?? '—' }}</td>
                  <td>{{ $result->time ?? $result->distance ?? '—' }}</td>
                  <td>{{ $result->points ?? '—' }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      @endforeach
    @else
      <div class="text-center py-5">
        <div class="mb-3" style="font-size: 3rem;">📊</div>
        <h3 class="h5 fw-bold mb-2">No Results Yet</h3>
        <p class="text-muted">Results will be posted after the first meet of the season.</p>
      </div>
    @endif
  </div>
</section>

@endsection