@extends('layouts.app')

@section('title', 'Athletes — Asylum Made Track & Field')

@section('meta_description')
View athletes participating in Asylum Made Track & Field programs.
@endsection

@section('content')

<section class="py-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <h1 class="h2 fw-bold mb-2">Athletes</h1>
        <p style="color: var(--muted);">Athletes competing in our track & field program.</p>
      </div>
    </div>

    @if($drivers->count() > 0)
      <div class="row g-4">
        @foreach($drivers as $driver)
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
              <h3 class="h5 fw-bold mb-1">{{ $driver->name }}</h3>
              @if($driver->team)
              <p class="text-muted small mb-2">{{ $driver->team->name }}</p>
              @endif
              @if($driver->age_division)
              <span class="badge mb-2" style="background-color: var(--accent-secondary); color: white;">{{ $driver->age_division }}</span>
              @endif
              <a href="{{ route('drivers.show', $driver->id) }}" class="stretched-link"></a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    @else
      <div class="text-center py-5">
        <div class="mb-3" style="font-size: 3rem;">🏃</div>
        <h3 class="h5 fw-bold mb-2">No Athletes Yet</h3>
        <p class="text-muted">Athletes will be listed here as they register.</p>
      </div>
    @endif
  </div>
</section>

@endsection