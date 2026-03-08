@extends('layouts.app')

@section('title', 'Asylum Made Track & Field — Riverview, Florida')

@section('meta_description')
Asylum Made Track & Field is a locally operated youth and adult track & field program based in Riverview, Florida, offering training, competitions, and community for athletes of all skill levels.
@endsection

@section('content')

{{-- Hero with Logo --}}
<section class="hero-band py-5">
  <div class="container py-lg-5">
    <div class="row align-items-center g-5">
      
      {{-- Logo and Branding --}}
      <div class="col-lg-6 text-center text-lg-start">
        <div class="mb-4">
          <img 
            src="/assets/images/icons/logo.png" 
            alt="ASYLUM MADE Track & Field" 
            class="img-fluid"
            style="max-height: 160px;"
          >
        </div>
        
        <h1 class="display-5 fw-bold mb-3" style="letter-spacing: -0.02em;">
          <span style="color: var(--ink);">TRACK & FIELD</span>
        </h1>
        
        <p class="lead mb-4" style="color: var(--muted); font-size: 1.2rem;">
          Riverview, Florida's premier youth & adult track program.<br>
          <strong style="color: var(--accent-primary);">Train. Compete. Excel.</strong>
        </p>
        
        <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start mb-5">
          <a href="/registration" class="btn btn-primary btn-lg px-4">
            Join Now
          </a>
          <a href="/schedule" class="btn btn-outline-secondary btn-lg px-4">
            View Schedule
          </a>
        </div>
        
        {{-- Stats --}}
        <div class="row g-4">
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
            <div class="stat-label">Meets</div>
          </div>
        </div>
      </div>
      
      {{-- Hero Image --}}
      <div class="col-lg-6">
        <div class="position-relative">
          <img
            src="/assets/images/hero/track-sunset.svg"
            alt="Asylum Made Track & Field - Riverview, Florida"
            class="w-100"
            style="border-radius: var(--radius-lg); border: 1px solid var(--border);"
            loading="eager"
          >
        </div>
      </div>
      
    </div>
  </div>
</section>

{{-- Why Asylum Made --}}
<section class="py-5">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-lg-8 text-center">
        <h2 class="h3 fw-bold mb-3">Built for Athletes of All Levels</h2>
        <p class="lead" style="color: var(--muted);">
          From first-time runners to competitive athletes, we develop champions through proper training, technique, and community.
        </p>
      </div>
    </div>
    
    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm" style="border-left: 4px solid var(--accent-primary) !important;">
          <div class="card-body text-center py-4">
            <div class="mb-3" style="font-size: 2rem;">🏃‍♂️</div>
            <h3 class="h5 fw-bold mb-2">All Ages</h3>
            <p class="text-muted small mb-0">Youth (6-18) and Masters (19+) programs</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm" style="border-left: 4px solid var(--accent-secondary) !important;">
          <div class="card-body text-center py-4">
            <div class="mb-3" style="font-size: 2rem;">⚡</div>
            <h3 class="h5 fw-bold mb-2">Proven Training</h3>
            <p class="text-muted small mb-0">Experienced coaches in all events</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm" style="border-left: 4px solid var(--accent-primary) !important;">
          <div class="card-body text-center py-4">
            <div class="mb-3" style="font-size: 2rem;">🏆</div>
            <h3 class="h5 fw-bold mb-2">Compete</h3>
            <p class="text-muted small mb-0">Regular meets and time trials</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm" style="border-left: 4px solid var(--accent-secondary) !important;">
          <div class="card-body text-center py-4">
            <div class="mb-3" style="font-size: 2rem;">💪</div>
            <h3 class="h5 fw-bold mb-2">Community</h3>
            <p class="text-muted small mb-0">Supportive team environment</p>
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
        <h2 class="h3 fw-bold mb-2">Track & Field Events</h2>
        <p style="color: var(--muted);">Full event program for every athlete</p>
      </div>
    </div>

    <div class="row g-4">
      @php
        $events = [
          ['name' => 'Sprints', 'desc' => '100m, 200m, 400m', 'color' => '#4b2e83'],
          ['name' => 'Distance', 'desc' => '800m, 1600m, 3200m', 'color' => '#5b7f2b'],
          ['name' => 'Hurdles', 'desc' => '100mH, 110mH, 300mH', 'color' => '#4b2e83'],
          ['name' => 'Long Jump', 'desc' => 'Long jump & triple jump', 'color' => '#5b7f2b'],
          ['name' => 'High Jump', 'desc' => 'Fosbury flop technique', 'color' => '#4b2e83'],
          ['name' => 'Throws', 'desc' => 'Shot put, discus, javelin', 'color' => '#5b7f2b'],
        ];
      @endphp
      
      @foreach ($events as $event)
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 border-0 shadow-sm event-card">
            <div class="card-body d-flex align-items-center">
              <div class="me-3" style="width: 56px; height: 56px; background-color: {{ $event['color'] }}15; border-radius: 12px; display: flex; align-items: center; justify-content: center; border: 1px solid {{ $event['color'] }}30;">
                <div style="width: 4px; height: 32px; background: {{ $event['color'] }}; border-radius: 2px;"></div>
              </div>
              <div>
                <h3 class="h5 fw-bold mb-1" style="color: {{ $event['color'] }};">{{ $event['name'] }}</h3>
                <p class="text-muted small mb-0">{{ $event['desc'] }}</p>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="text-center mt-5">
      <a href="/events" class="btn btn-outline-secondary px-4">
        View All Events →
      </a>
    </div>
  </div>
</section>

{{-- Age Divisions --}}
<section class="py-5">
  <div class="container">
    <div class="row align-items-center mb-5">
      <div class="col-lg-6">
        <h2 class="h3 fw-bold mb-2">Age Divisions</h2>
      </div>
      <div class="col-lg-6 text-lg-end">
        <p style="color: var(--muted);">Compete with athletes your age</p>
      </div>
    </div>
    
    <div class="row g-3 justify-content-center">
      <div class="col-6 col-md-4 col-lg-2">
        <div class="card h-100 border-0 text-center" style="background: var(--surface-soft);">
          <div class="card-body py-4">
            <div class="stat-number" style="font-size: 2rem;">6-8</div>
            <div class="small fw-semibold" style="color: var(--accent-primary);">Bantam</div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-2">
        <div class="card h-100 border-0 text-center" style="background: var(--surface-soft);">
          <div class="card-body py-4">
            <div class="stat-number" style="font-size: 2rem;">9-10</div>
            <div class="small fw-semibold" style="color: var(--accent-secondary);">Midget</div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-2">
        <div class="card h-100 border-0 text-center" style="background: var(--surface-soft);">
          <div class="card-body py-4">
            <div class="stat-number" style="font-size: 2rem;">11-12</div>
            <div class="small fw-semibold" style="color: var(--accent-primary);">Youth</div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-2">
        <div class="card h-100 border-0 text-center" style="background: var(--surface-soft);">
          <div class="card-body py-4">
            <div class="stat-number" style="font-size: 2rem;">13-14</div>
            <div class="small fw-semibold" style="color: var(--accent-secondary);">Intermediate</div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-2">
        <div class="card h-100 border-0 text-center" style="background: var(--surface-soft);">
          <div class="card-body py-4">
            <div class="stat-number" style="font-size: 2rem;">15-18</div>
            <div class="small fw-semibold" style="color: var(--accent-primary);">Young Adult</div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4 col-lg-2">
        <div class="card h-100 border-0 text-center" style="background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));">
          <div class="card-body py-4">
            <div class="stat-number" style="font-size: 2rem; color: white;">19+</div>
            <div class="small fw-bold" style="color: white;">Masters</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- CTA Section --}}
<section class="py-5" style="background-color: var(--brand-charcoal);">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <h2 class="h3 fw-bold mb-3 text-white">Ready to Compete?</h2>
        <p class="lead mb-4" style="color: rgba(255,255,255,0.75);">
          Join Asylum Made Track & Field. Learn proper technique, build fitness, and compete with pride.
        </p>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
          <a href="/registration" class="btn btn-primary btn-lg px-5">
            Register Now
          </a>
          <a href="/contact" class="btn btn-outline-secondary btn-lg px-4" style="color: white; border-color: rgba(255,255,255,0.3);">
            Contact Us
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Quick Links --}}
<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4">
        <a href="/schedule" class="card h-100 text-decoration-none border-0 shadow-sm quick-link-card">
          <div class="card-body text-center py-5">
            <div class="mb-3" style="width: 64px; height: 64px; margin: 0 auto; background-color: var(--accent-primary); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
              </svg>
            </div>
            <h3 class="h5 fw-bold mb-2">Meet Schedule</h3>
            <p style="color: var(--muted);" class="small mb-0">Upcoming meets and events</p>
          </div>
        </a>
      </div>
      <div class="col-md-4">
        <a href="/results" class="card h-100 text-decoration-none border-0 shadow-sm quick-link-card">
          <div class="card-body text-center py-5">
            <div class="mb-3" style="width: 64px; height: 64px; margin: 0 auto; background-color: var(--accent-secondary); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                <path d="M12 20V10"></path>
                <path d="M18 20V4"></path>
                <path d="M6 20v-4"></path>
              </svg>
            </div>
            <h3 class="h5 fw-bold mb-2">Results & Times</h3>
            <p style="color: var(--muted);" class="small mb-0">Meet results and personal records</p>
          </div>
        </a>
      </div>
      <div class="col-md-4">
        <a href="/about" class="card h-100 text-decoration-none border-0 shadow-sm quick-link-card">
          <div class="card-body text-center py-5">
            <div class="mb-3" style="width: 64px; height: 64px; margin: 0 auto; background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary)); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="16" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12.01" y2="8"></line>
              </svg>
            </div>
            <h3 class="h5 fw-bold mb-2">About Us</h3>
            <p style="color: var(--muted);" class="small mb-0">Learn more about our program</p>
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
          style="border: 1px solid var(--border);"
          loading="lazy"
        >
      </div>
      <div class="col-md-6">
        <span class="badge mb-3" style="background-color: var(--accent-primary); color: white;">LOCATION</span>
        <h2 class="h3 fw-bold mb-3">Training in Riverview, Florida</h2>
        <p style="color: var(--muted);" class="mb-4">
          We train at local track facilities. Practices are held Tuesday and Thursday evenings with Saturday morning meets during the season.
        </p>
        <div class="d-flex flex-column gap-3">
          <div class="d-flex align-items-center">
            <div style="width: 48px; height: 48px; background-color: var(--accent-primary); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
            </div>
            <div>
              <div class="fw-semibold">Riverview, Florida</div>
              <div class="small" style="color: var(--muted);">Hillsborough County</div>
            </div>
          </div>
          <div class="d-flex align-items-center">
            <div style="width: 48px; height: 48px; background-color: var(--accent-secondary); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
            </div>
            <div>
              <div class="fw-semibold">Practice Schedule</div>
              <div class="small" style="color: var(--muted);">Tue/Thu 6PM • Sat 9AM</div>
            </div>
          </div>
          <div class="d-flex align-items-center">
            <div style="width: 48px; height: 48px; background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary)); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
              </svg>
            </div>
            <div>
              <div class="fw-semibold">All Welcome</div>
              <div class="small" style="color: var(--muted);">All ages and skill levels</div>
            </div>
          </div>
        </div>
        <a href="/contact" class="btn btn-primary mt-4 px-4">
          Get Directions →
        </a>
      </div>
    </div>
  </div>
</section>

{{-- Hover styles --}}
@push('styles')
<style>
  .event-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
  }
  
  .quick-link-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    border-color: var(--accent-primary) !important;
  }
  
  .quick-link-card:hover h3 {
    color: var(--accent-primary);
  }
</style>
@endpush

@endsection