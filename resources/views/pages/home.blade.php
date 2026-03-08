@extends('layouts.app')

@section('title', 'Asylum Made Track & Field — Riverview, Florida')

@section('meta_description')
Asylum Made Track & Field is a locally operated youth and adult track & field program based in Riverview, Florida, offering training, competitions, and community for athletes of all skill levels.
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
          <span class="text-gradient">Track & Field</span> in Riverview
        </h1>
        <p class="display-6 fw-semibold text-secondary mb-3" style="font-size: 1.5rem;">
          Youth &amp; Adult Programs
        </p>
        <p class="lead text-muted">
          Asylum Made Track & Field provides training and competition opportunities for athletes 
          in Riverview, Florida. From sprinters to throwers, beginners to competitors — all are welcome.
        </p>

        <div class="mt-4 d-flex flex-wrap gap-3">
          <a href="/schedule" class="btn btn-primary btn-lg px-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-2">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
              <line x1="16" y1="2" x2="16" y2="6"></line>
              <line x1="8" y1="2" x2="8" y2="6"></line>
              <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            Meet Schedule
          </a>
          <a href="/registration" class="btn btn-outline-primary btn-lg px-4">
            Register Now
          </a>
        </div>

        {{-- Quick Stats --}}
        <div class="row mt-5 g-4">
          <div class="col-4">
            <div class="stat-number">50+</div>
            <div class="stat-label">Athletes</div>
          </div>
          <div class="col-4">
            <div class="stat-number">15</div>
            <div class="stat-label">Events</div>
          </div>
          <div class="col-4">
            <div class="stat-number">12</div>
            <div class="stat-label">Meets/Year</div>
          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="hero-image-container">
          <img
            src="/assets/images/hero/track-sunset.svg"
            alt="Asylum Made Track & Field - Riverview, Florida"
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
            <h2 class="h3 fw-bold mb-3">Built for <span class="text-primary">athletes</span> of all levels</h2>
            <p class="text-muted mb-4">
              We're a local track & field club focused on developing athletes through proper training, 
              technique, and competition experience. Youth and adults welcome.
            </p>
            <ul class="list-unstyled">
              <li class="mb-3 d-flex align-items-start">
                <span class="text-primary me-2">✓</span>
                <span>Experienced coaches in sprints, distance, and field events</span>
              </li>
              <li class="mb-3 d-flex align-items-start">
                <span class="text-primary me-2">✓</span>
                <span>Age-appropriate training for youth athletes (6-18)</span>
              </li>
              <li class="mb-3 d-flex align-items-start">
                <span class="text-primary me-2">✓</span>
                <span>Masters division for adults 19+</span>
              </li>
              <li class="mb-3 d-flex align-items-start">
                <span class="text-primary me-2">✓</span>
                <span>Regular meets and time trials throughout the season</span>
              </li>
            </ul>
          </div>
          <div class="col-md-6">
            <img
              src="/assets/images/hero/racing-action.svg"
              alt="Track & field athletes competing"
              class="w-100 rounded shadow-sm"
              loading="lazy"
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Events Overview --}}
<section class="py-5 bg-light">
  <div class="container">
    <div class="row mb-5">
      <div class="col text-center">
        <h2 class="h3 fw-bold">Track & Field Events</h2>
        <p class="text-muted">Full event schedule for all athletes</p>
      </div>
    </div>

    <div class="row g-4">
      @php
        $events = [
          ['name' => 'Sprints', 'desc' => '100m, 200m, 400m — pure speed', 'color' => '#D45500', 'icon' => '⚡'],
          ['name' => 'Distance', 'desc' => '800m, 1600m, 3200m — endurance', 'color' => '#1E3A5F', 'icon' => '🏃'],
          ['name' => 'Hurdles', 'desc' => '100mH, 110mH, 300mH — technique + speed', 'color' => '#059669', 'icon' => '🏔'],
          ['name' => 'Long Jump', 'desc' => 'Running long jump and triple jump', 'color' => '#7C3AED', 'icon' => '⬆'],
          ['name' => 'High Jump', 'desc' => 'Fosbury flop technique training', 'color' => '#E11D48', 'icon' => '🎯'],
          ['name' => 'Throws', 'desc' => 'Shot put, discus, javelin', 'color' => '#F59E0B', 'icon' => '💪'],
        ];
      @endphp
      
      @foreach ($events as $event)
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
              <div class="d-flex align-items-center mb-2">
                <div class="me-3" style="width: 4px; height: 40px; background: {{ $event['color'] }}; border-radius: 2px;"></div>
                <div>
                  <span class="fs-3 me-2">{{ $event['icon'] }}</span>
                  <h3 class="h5 fw-semibold mb-0 d-inline">{{ $event['name'] }}</h3>
                </div>
              </div>
              <p class="text-muted small mb-0 ms-4">{{ $event['desc'] }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="text-center mt-4">
      <a href="/rules" class="btn btn-outline-secondary">View Event Rules & Regulations</a>
    </div>
  </div>
</section>

{{-- Age Groups --}}
<section class="py-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col text-center">
        <h2 class="h3 fw-bold">Age Divisions</h2>
        <p class="text-muted">Compete with athletes your age</p>
      </div>
    </div>
    
    <div class="row g-4 justify-content-center">
      <div class="col-md-3">
        <div class="card h-100 text-center shadow-sm border-0">
          <div class="card-body py-4">
            <div class="stat-number">6-8</div>
            <div class="stat-label">Bantam</div>
            <p class="small text-muted mb-0 mt-2">Born 2018-2020</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card h-100 text-center shadow-sm border-0">
          <div class="card-body py-4">
            <div class="stat-number">9-10</div>
            <div class="stat-label">Midget</div>
            <p class="small text-muted mb-0 mt-2">Born 2016-2017</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card h-100 text-center shadow-sm border-0">
          <div class="card-body py-4">
            <div class="stat-number">11-12</div>
            <div class="stat-label">Youth</div>
            <p class="small text-muted mb-0 mt-2">Born 2014-2015</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card h-100 text-center shadow-sm border-0">
          <div class="card-body py-4">
            <div class="stat-number">13-14</div>
            <div class="stat-label">Intermediate</div>
            <p class="small text-muted mb-0 mt-2">Born 2012-2013</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row g-4 justify-content-center mt-2">
      <div class="col-md-4">
        <div class="card h-100 text-center shadow-sm border-0">
          <div class="card-body py-4">
            <div class="stat-number">15-18</div>
            <div class="stat-label">Young Adult</div>
            <p class="small text-muted mb-0 mt-2">Born 2008-2011</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 text-center shadow-sm border-0">
          <div class="card-body py-4">
            <div class="stat-number">19+</div>
            <div class="stat-label">Masters</div>
            <p class="small text-muted mb-0 mt-2">Born 2007 or earlier</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Call to Action --}}
<section class="py-5 bg-secondary text-white">
  <div class="container">
    <div class="row align-items-center g-4">
      <div class="col-lg-8">
        <h3 class="h4 fw-semibold mb-2">Ready to compete?</h3>
        <p class="mb-0 opacity-75">
          Join our track & field program. Learn proper technique, build fitness, and compete in local meets.
        </p>
      </div>
      <div class="col-lg-4 text-lg-end">
        <a href="/registration" class="btn btn-accent btn-lg">Register Now</a>
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
            <h3 class="h5 fw-semibold">Meet Schedule</h3>
            <p class="text-muted small mb-0">Upcoming meets and events</p>
          </div>
        </a>
      </div>
      <div class="col-md-4">
        <a href="/results" class="card h-100 text-decoration-none border-0 shadow-sm">
          <div class="card-body text-center py-5">
            <div class="mb-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-primary">
                <path d="M12 20V10"></path>
                <path d="M18 20V4"></path>
                <path d="M6 20v-4"></path>
              </svg>
            </div>
            <h3 class="h5 fw-semibold">Results & Times</h3>
            <p class="text-muted small mb-0">Meet results and personal records</p>
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
          alt="Track & field facilities at Asylum Made"
          class="w-100 rounded shadow-sm"
          loading="lazy"
        >
      </div>
      <div class="col-md-6">
        <h2 class="h3 fw-bold mb-3">Training Location</h2>
        <p class="text-muted mb-4">
          We train at local track facilities in Riverview, Florida. Practices are held 
          Tuesday and Thursday evenings with Saturday morning meets during the season.
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
            <span class="text-muted">Practice: Tue/Thu 6PM • Sat 9AM</span>
          </div>
          <div class="d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-primary me-2">
              <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
              <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span class="text-muted">All ages and skill levels welcome</span>
          </div>
        </div>
        <a href="/contact" class="btn btn-primary mt-4">Get Directions</a>
      </div>
    </div>
  </div>
</section>

@endsection