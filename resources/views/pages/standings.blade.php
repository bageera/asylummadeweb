@extends('layouts.app')

@section('title', 'Standings — Asylum Made Track & Field')

@section('meta_description')
View current season standings and point totals for Asylum Made Track & Field athletes.
@endsection

@section('content')

<section class="py-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <h1 class="h2 fw-bold mb-2">Season Standings</h1>
        <p style="color: var(--muted);">Current point standings for the {{ $currentSeason?->name ?? 'current season' }}.</p>
      </div>
    </div>

    @if($standings->count() > 0)
      @foreach($standings as $classId => $classStandings)
      <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-white">
          <h3 class="h5 fw-bold mb-0">{{ $classStandings->first()?->vehicleClass?->name ?? 'Event Class' }}</h3>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table mb-0">
              <thead>
                <tr>
                  <th>Rank</th>
                  <th>Athlete</th>
                  <th>Team</th>
                  <th>Points</th>
                </tr>
              </thead>
              <tbody>
                @foreach($classStandings as $standing)
                <tr>
                  <td><strong>{{ $loop->iteration }}</strong></td>
                  <td>{{ $standing->driver?->name ?? '—' }}</td>
                  <td>{{ $standing->driver?->team?->name ?? '—' }}</td>
                  <td><strong>{{ $standing->points }}</strong></td>
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
        <div class="mb-3" style="font-size: 3rem;">🏆</div>
        <h3 class="h5 fw-bold mb-2">No Standings Yet</h3>
        <p class="text-muted">Standings will be calculated after the first meet of the season.</p>
      </div>
    @endif
  </div>
</section>

@endsection