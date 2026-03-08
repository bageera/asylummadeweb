@extends('layouts.app')

@section('title', 'Asylum Made Track — Riverview, Florida')

@section('meta_description')
Asylum Made Track is a locally operated track league based in Riverview, Florida, focused on fair competition, clear rules, and consistent race operations.
@endsection

@section('content')

{{-- Hero --}}
<section class="py-5 hero-section">
  <div class="container py-lg-5">
    <div class="row align-items-center g-5">

      <div class="col-lg-7">
        <div class="d-inline-block mb-3">
          <span class="badge bg-accent text-dark mb-2">2026 Season</span>
        </div>
        <h1 class="display-5 fw-bold mb-3">
          <span class="text-gradient">Racing</span> in Riverview
        </h1>
        <p class="display-6 fw-semibold text-secondary mb-3" style="font-size: 1.5rem;">
          Local Track League
        </p>
        <p class="lead text-muted">
          Saturday night racing at Asylum Made Track in Riverview, Florida.
          Fair competition, clear rules, and a well-managed environment for drivers, teams, and families.
        </p>

        <div class="mt-4 d-flex flex-wrap gap-3">
          <a href="/schedule" class="btn btn-primary btn-lg px-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-2">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
              <line x1="16" y1="2" x2="16" y2="6"></line>
              <line x1="8" y1="2" x2="8" y2="6"></line>
              <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            View Schedule
          </a>
          <a href="/registration" class="btn btn-outline-primary btn-lg px-4">
            Register to Race
          </a>
        </div>

        {{-- Quick Stats --}}
        <div class="row mt-5 g-4">
          <div class="col-4">
            <div class="stat-number">8</div>
            <div class="stat-label">Race Classes</div>
          </div>
          <div class="col-4">
            <div class="stat-number">20+</div>
            <div class="stat-label">Events/Year</div>
          </div>
          <div class="col-4">
            <div class="stat-number">100+</div>
            <div class="stat-label">Drivers</div>
          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="hero-image-container">
          <img
            src="/assets/images/hero/track-sunset.svg"
            alt="Asylum Made Track - Florida sunset racing"
            class="w-100 h-100 object-fit-cover"
            loading="eager"
          >
        </div>
      </div>

    </div>
  </div>
</section>

{{-- About Section --}}
<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="row align-items-center g-5">
          <div class="col-md-6">
            <h2 class="h3 fw-bold mb-3">Built for <span class="text-primary">racers</span>, not promoters</h2>
            <p class="text-muted mb-4">
              We're a local track league focused on what matters: fair racing, consistent operations, 
              and a great experience for drivers and families alike.
            </p>
            <ul class="list-unstyled">
              <li class="mb-3 d-flex align-items-start">
                <span class="text-primary me-2">✓</span>
                <span>Transparent rules and consistent enforcement</span>
              </li>
              <li class="mb-3 d-flex align-items-start">
                <span class="text-primary me-2">✓</span>
                <span>Multiple classes from entry-level to modified</span>
              </li>
              <li class="mb-3 d-flex align-items-start">
                <span class="text-primary me-2">✓</span>
                <span>Family-friendly atmosphere with affordable admission</span>
              </li>
              <li class="mb-3 d-flex align-items-start">
                <span class="text-primary me-2">✓</span>
                <span>Points championship with season-end awards</span>
              </li>
            </ul>
          </div>
          <div class="col-md-6">
            <img
              src="/assets/images/hero/racing-action.svg"
              alt="Racing action at Asylum Made Track"
              class="w-100 rounded shadow-sm"
              loading="lazy"
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Classes Overview --}}
<section class="py-5 bg-light">
  <div class="container">
    <div class="row mb-5">
      <div class="col text-center">
        <h2 class="h3 fw-bold">Race Classes</h2>
        <p class="text-muted">From beginners to seasoned veterans</p>
      </div>
    </div>

    <div class="row g-4">
      @php
        $classes = [
          ['name' => 'Hornet', 'desc' => 'Entry-level 4-cylinder class for beginners', 'color' => '#059669'],
          ['name' => 'Mini Stock', 'desc' => 'Compact cars with limited modifications', 'color' => '#0284C7'],
          ['name' => 'Pure Stock', 'desc' => 'Near-stock class with minimal changes', 'color' => '#6366F1'],
          ['name' => 'Street Stock', 'desc' => 'Street-legal appearance with performance mods', 'color' => '#D45500'],
          ['name' => 'Super Stock', 'desc' => 'Enhanced engine modifications allowed', 'color' => '#E11D48'],
          ['name' => 'Modified', 'desc' => 'Open-wheel modifieds with significant modifications', 'color' => '#1E3A5F'],
        ];
      @endphp
      
      @foreach ($classes as $class)
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
              <div class="d-flex align-items-center mb-2">
                <div class="me-3" style="width: 4px; height: 40px; background: {{ $class['color'] }}; border-radius: 2px;"></div>
                <h3 class="h5 fw-semibold mb-0">{{ $class['name'] }}</h3>
              </div>
              <p class="text-muted small mb-0 ms-4">{{ $class['desc'] }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="text-center mt-4">
      <a href="/rules" class="btn btn-outline-secondary">View All Classes & Rules</a>
    </div>
  </div>
</section>

{{-- Call to Action --}}
<section class="py-5 bg-secondary text-white">
  <div class="container">
    <div class="row align-items-center g-4">
      <div class="col-lg-8">
        <h3 class="h4 fw-semibold mb-2">Ready to get on track?</h3>
        <p class="mb-0 opacity-75">
          New drivers welcome. Learn about registration requirements, class specifications, and season schedule.
        </p>
      </div>
      <div class="col-lg-4 text-lg-end">
        <a href="/registration" class="btn btn-accent btn-lg">Start Registration</a>
      </div>
    </div>
  </div>
</section>

{{-- Quick Links --}}
<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4">
        <a href="/schedule" class="card h-100 text-decoration-none border-0 shadow-sm">
          <div class="card-body text-center py-5">
            <div class="mb-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-primary">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
              </svg>
            </div>
            <h3 class="h5 fw-semibold">Schedule & Results</h3>
            <p class="text-muted small mb-0">Upcoming events and past results</p>
          </div>
        </a>
      </div>
      <div class="col-md-4">
        <a href="/rules" class="card h-100 text-decoration-none border-0 shadow-sm">
          <div class="card-body text-center py-5">
            <div class="mb-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-primary">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
              </svg>
            </div>
            <h3 class="h5 fw-semibold">Rules & Classes</h3>
            <p class="text-muted small mb-0">Technical specs and regulations</p>
          </div>
        </a>
      </div>
      <div class="col-md-4">
        <a href="/contact" class="card h-100 text-decoration-none border-0 shadow-sm">
          <div class="card-body text-center py-5">
            <div class="mb-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-primary">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
              </svg>
            </div>
            <h3 class="h5 fw-semibold">Contact Us</h3>
            <p class="text-muted small mb-0">Questions about registration</p>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>

{{-- Location Section --}}
<section class="py-5 bg-light border-top">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-md-6">
        <img
          src="/assets/images/hero/pit-area.svg"
          alt="Pit area at Asylum Made Track"
          class="w-100 rounded shadow-sm"
          loading="lazy"
        >
      </div>
      <div class="col-md-6">
        <h2 class="h3 fw-bold mb-3">Visit the Track</h2>
        <p class="text-muted mb-4">
          Located in Riverview, Florida, just minutes from Tampa. Gates open at 4 PM on race days 
          with practice starting at 5 PM and racing at 7 PM.
        </p>
        <div class="d-flex flex-column gap-2">
          <div class="d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-primary me-2">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
              <circle cx="12" cy="10" r="3"></circle>
            </svg>
            <span class="text-muted">Riverview, Florida</span>
          </div>
          <div class="d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-primary me-2">
              <circle cx="12" cy="12" r="10"></circle>
              <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
            <span class="text-muted">Gates Open: 4:00 PM</span>
          </div>
          <div class="d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-primary me-2">
              <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
              <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span class="text-muted">Saturday Night Racing</span>
          </div>
        </div>
        <a href="/contact" class="btn btn-primary mt-4">Get Directions</a>
      </div>
    </div>
  </div>
</section>

@endsection
