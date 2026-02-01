@extends('layouts.app')

@section('title', 'Rules & Classes — Asylum Made Track')

@section('meta_description')
League rules, class definitions, and competition standards for the Asylum Made Track local league in Riverview, Florida.
@endsection

@section('content')

{{-- Page Header --}}
<section class="py-5 border-bottom">
  <div class="container">
    <h1 class="h3 fw-semibold mb-3">Rules & Classes</h1>
    <p class="text-muted max-w-lg">
      This page outlines the rules, class structure, and competition standards
      for the current season. All participants are expected to review and follow
      these guidelines.
    </p>
  </div>
</section>

{{-- Rules Overview --}}
<section class="py-5">
  <div class="container">

    <h2 class="h5 fw-semibold mb-3">General rules</h2>

    <div class="row g-4">

      @foreach ([
        'All participants must complete registration prior to competition.',
        'Safety equipment requirements must be met at all times.',
        'Vehicles must pass pre-race inspection for the applicable class.',
        'Unsportsmanlike conduct may result in penalties or removal.',
        'Decisions by league officials are final.'
      ] as $rule)

      <div class="col-md-6">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <p class="mb-0">{{ $rule }}</p>
          </div>
        </div>
      </div>

      @endforeach

    </div>

  </div>
</section>

{{-- Classes --}}
<section class="py-5 bg-light border-top border-bottom">
  <div class="container">

    <h2 class="h5 fw-semibold mb-4">Competition classes</h2>

    <div class="row g-4">

      @foreach ([
        [
          'name' => 'Stock Class',
          'description' => 'Entry-level class with limited vehicle modifications.',
          'requirements' => [
            'Factory engine and drivetrain',
            'OEM suspension configuration',
            'Approved safety gear required'
          ]
        ],
        [
          'name' => 'Modified Class',
          'description' => 'Expanded modifications permitted within defined limits.',
          'requirements' => [
            'Aftermarket suspension allowed',
            'Engine modifications within class limits',
            'Additional safety equipment required'
          ]
        ],
        [
          'name' => 'Open Class',
          'description' => 'Advanced class with broader modification allowances.',
          'requirements' => [
            'Open engine configuration',
            'Custom suspension setups allowed',
            'Highest safety standard enforced'
          ]
        ]
      ] as $class)

      <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm h-100">

          <div class="card-body">
            <h3 class="h6 fw-semibold">{{ $class['name'] }}</h3>
            <p class="text-muted small mt-2">
              {{ $class['description'] }}
            </p>

            <ul class="text-muted small mt-3 mb-0">
              @foreach ($class['requirements'] as $req)
                <li>{{ $req }}</li>
              @endforeach
            </ul>
          </div>

        </div>
      </div>

      @endforeach

    </div>

  </div>
</section>

{{-- Enforcement --}}
<section class="py-5">
  <div class="container">

    <h2 class="h5 fw-semibold mb-3">Enforcement & protests</h2>

    <div class="row">
      <div class="col-lg-8">
        <p class="text-muted">
          Rules are enforced by designated league officials. Protests must be
          submitted according to league procedures and within the defined time
          window following an event.
        </p>

        <p class="text-muted mb-0">
          All penalties, rulings, and interpretations are documented to ensure
          consistency across events and seasons.
        </p>
      </div>
    </div>

  </div>
</section>

{{-- Callout --}}
<section class="py-5 border-top">
  <div class="container d-flex flex-column flex-lg-row justify-content-between align-items-center gap-3">
    <div>
      <h3 class="h5 fw-semibold mb-1">Questions about class eligibility?</h3>
      <p class="text-muted mb-0">
        Contact the league before an event to avoid issues on race day.
      </p>
    </div>
    <a href="/contact" class="btn btn-dark px-4">Contact the league</a>
  </div>
</section>

@endsection
