@extends('layouts.app')

@section('title', 'Asylum Made Track — Riverview, FL')

@section('meta_description')
Asylum Made Track is a locally operated track league based in Riverview, Florida, focused on fair competition, clear rules, and consistent race operations.
@endsection

@section('content')

{{-- Hero --}}
<section class="py-5 bg-light border-bottom">
  <div class="container py-lg-5">
    <div class="row align-items-center g-5">

      <div class="col-lg-7">
        <h1 class="display-6 fw-semibold">
          A structured home for local track competition
        </h1>

        <p class="lead text-muted mt-3">
          Asylum Made Track operates a local track league in Riverview, Florida,
          with an emphasis on fairness, safety, and clear communication for all participants.
        </p>

        <div class="mt-4 d-flex gap-3">
          <a href="/contact" class="btn btn-dark px-4">Get involved</a>
          <a href="/services" class="btn btn-outline-secondary px-4">League operations</a>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="ratio ratio-4x3 rounded overflow-hidden shadow-sm">
          <img
            src="/assets/images/hero/workspace-01.jpg"
            alt="Local track league environment"
            class="w-100 h-100 object-fit-cover"
            loading="eager"
          >
        </div>
      </div>

    </div>
  </div>
</section>

{{-- Orientation --}}
<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-9 text-center">
        <h2 class="h4 fw-semibold mb-3">
          Built for participants, not promotion
        </h2>
        <p class="text-muted">
          The league is designed to support consistent race operations, transparent rules,
          and a well-managed environment for drivers, teams, and officials.
        </p>
      </div>
    </div>
  </div>
</section>

{{-- Capabilities Overview --}}
<section class="py-5 bg-light">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <h2 class="h4 fw-semibold">League focus areas</h2>
        <p class="text-muted mb-0">
          These areas define how the league is organized and operated.
        </p>
      </div>
    </div>

    <div class="row g-4">
      @foreach ([
        'Event management',
        'Rules & governance',
        'Participant coordination',
        'Operations & logistics',
        'Records & continuity',
        'League development'
      ] as $area)
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <h3 class="h6 fw-semibold">{{ $area }}</h3>
              <p class="text-muted small mb-0">
                Structured processes designed to keep events consistent and fair.
              </p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Call to Action --}}
<section class="py-5 border-top">
  <div class="container d-flex flex-column flex-lg-row justify-content-between align-items-center gap-3">
    <div>
      <h3 class="h5 fw-semibold mb-1">Interested in participating?</h3>
      <p class="text-muted mb-0">
        Reach out with questions about events, registration, or league operations.
      </p>
    </div>
    <a href="/contact" class="btn btn-dark px-4">Contact the league</a>
  </div>
</section>

@endsection
