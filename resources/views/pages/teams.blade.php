@extends('layouts.app')

@section('title', 'Teams — Asylum Made Track & Field')

@section('meta_description')
View teams participating in Asylum Made Track & Field programs.
@endsection

@section('content')

<section class="py-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <h1 class="h2 fw-bold mb-2">Teams</h1>
        <p style="color: var(--muted);">Teams and clubs participating in our track & field program.</p>
      </div>
    </div>

    @if($teams->count() > 0)
      <div class="row g-4">
        @foreach($teams as $team)
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
              @if($team->logo)
              <img src="{{ $team->logo }}" alt="{{ $team->name }}" class="mb-3" style="max-height: 60px;">
              @endif
              <h3 class="h5 fw-bold mb-2">{{ $team->name }}</h3>
              @if($team->city || $team->state)
              <p class="text-muted small mb-2">📍 {{ $team->city }}{{ $team->city && $team->state ? ', ' : '' }}{{ $team->state }}</p>
              @endif
              @if($team->drivers->count() > 0)
              <p class="small mb-0"><strong>{{ $team->drivers->count() }}</strong> athlete{{ $team->drivers->count() !== 1 ? 's' : '' }}</p>
              @endif
              <a href="{{ route('teams.show', $team->id) }}" class="stretched-link"></a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    @else
      <div class="text-center py-5">
        <div class="mb-3" style="font-size: 3rem;">👥</div>
        <h3 class="h5 fw-bold mb-2">No Teams Yet</h3>
        <p class="text-muted">Teams will be listed here as they register.</p>
      </div>
    @endif
  </div>
</section>

@endsection