@extends('layouts.app')

@section('title', 'About — asylummadetrack')

@section('content')

<section class="py-5 border-bottom">
  <div class="container">
    <h1 class="h3 fw-semibold mb-3">About</h1>
    <p class="text-muted max-w-lg">
      asylummade focuses on building clear, maintainable foundations for modern work.
      The emphasis is on structure, continuity, and long-term usability.
    </p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4">

      <div class="col-md-6">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h2 class="h6 fw-semibold">How we work</h2>
            <p class="text-muted mt-3">
              Engagements are approached methodically. We begin by understanding
              what already exists, identifying what should be preserved, and
              improving only what is necessary.
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h2 class="h6 fw-semibold">What we prioritize</h2>
            <ul class="text-muted mt-3 mb-0">
              <li>Clarity over cleverness</li>
              <li>Stability over trend-chasing</li>
              <li>Incremental improvement</li>
              <li>Operational transparency</li>
            </ul>
          </div>
        </div>
      </div>

    </div>

    <div class="row mt-5">
      <div class="col-lg-8">
        <h3 class="h6 fw-semibold mb-2">Designed for continuity</h3>
        <p class="text-muted">
          Many projects involve existing systems, established messaging, and
          operational constraints. Our role is to modernize thoughtfully without
          erasing what already works.
        </p>
      </div>
    </div>
  </div>
</section>

@include('partials.sections.callout')

@endsection
