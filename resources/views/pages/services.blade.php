@extends('layouts.app')

@section('title', 'League Operations — Asylum Made Track')

@section('meta_description')
Overview of how the Asylum Made Track league is organized and operated, including events, rules, coordination, and long-term continuity.
@endsection

@section('content')

{{-- Header --}}
<section class="py-5 border-bottom">
  <div class="container">
    <h1 class="h3 fw-semibold mb-3">League operations</h1>
    <p class="text-muted max-w-lg">
      The league is managed through defined operational areas that support events,
      participants, and long-term continuity.
    </p>
  </div>
</section>

{{-- Operations Grid --}}
<section class="py-5">
  <div class="container">
    <div class="row g-4">

      @foreach ([
        [
          'title' => 'Event Management',
          'items' => [
            'Race scheduling',
            'Event formats and classes',
            'Grid and heat organization',
            'Results tracking'
          ]
        ],
        [
          'title' => 'Rules & Governance',
          'items' => [
            'League ruleset',
            'Class definitions',
            'Penalty and protest handling',
            'Safety standards'
          ]
        ],
        [
          'title' => 'Participant Coordination',
          'items' => [
            'Driver registration',
            'Team coordination',
            'League communications',
            'New participant onboarding'
          ]
        ],
        [
          'title' => 'Operations & Logistics',
          'items' => [
            'Track-day operations',
            'Volunteer coordination',
            'Equipment requirements',
            'Day-of execution'
          ]
        ],
        [
          'title' => 'Records & Continuity',
          'items' => [
            'Season standings',
            'Historical results',
            'Rule changes by season',
            'Operational documentation'
          ]
        ],
        [
          'title' => 'League Development',
          'items' => [
            'Format evaluation',
            'Participant feedback',
            'Season planning',
            'Incremental improvements'
          ]
        ]
      ] as $group)

      <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">

          <div class="ratio ratio-1x1">
            <img
              src="/assets/images/services/{{ \Illuminate\Support\Str::slug($group['title']) }}.jpg"
              alt="{{ $group['title'] }} context"
              class="w-100 h-100 object-fit-cover"
              loading="lazy"
            >
          </div>

          <div class="card-body">
            <h2 class="h6 fw-semibold">{{ $group['title'] }}</h2>
            <ul class="text-muted small mt-3 mb-0">
              @foreach ($group['items'] as $item)
                <li>{{ $item }}</li>
              @endforeach
            </ul>
          </div>

        </div>
      </div>

      @endforeach

    </div>
  </div>
</section>

{{-- Callout --}}
<section class="py-5 bg-light border-top">
  <div class="container d-flex flex-column flex-lg-row justify-content-between align-items-center gap-3">
    <div>
      <h3 class="h5 fw-semibold mb-1">Questions about how the league runs?</h3>
      <p class="text-muted mb-0">
        We’re happy to clarify rules, formats, or participation details.
      </p>
    </div>
    <a href="/contact" class="btn btn-dark px-4">Contact the league</a>
  </div>
</section>

@endsection
