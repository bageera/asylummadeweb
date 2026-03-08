@extends('layouts.app')

@section('title', 'Asylum Made Track & Field — Riverview, Florida')

@section('meta_description')
Asylum Made Track & Field is a locally operated youth and adult track & field program based in Riverview, Florida, offering training, competitions, and community for athletes of all skill levels.
@endsection

@section('content')

{{-- Hero with Logo --}}
<section class="hero-section position-relative overflow-hidden">
  {{-- Animated background elements --}}
  <div class="position-absolute w-100 h-100" style="top: 0; left: 0; opacity: 0.1; pointer-events: none;">
    <div class="position-absolute" style="top: 10%; right: 5%; width: 300px; height: 300px; background: radial-gradient(circle, #7FFF00 0%, transparent 70%); filter: blur(80px);"></div>
    <div class="position-absolute" style="bottom: 20%; left: 10%; width: 250px; height: 250px; background: radial-gradient(circle, #8A2BE2 0%, transparent 70%); filter: blur(80px);"></div>
  </div>
  
  <div class="container py-5 position-relative">
    <div class="row align-items-center g-5 min-vh-75">
      
      {{-- Logo and Branding --}}
      <div class="col-lg-6 text-center text-lg-start">
        <div class="mb-4">
          <img 
            src="/assets/images/icons/logo.png" 
            alt="ASYLUM MADE Track & Field" 
            class="img-fluid"
            style="max-height: 180px; filter: drop-shadow(0 0 30px rgba(127, 255, 0, 0.4));"
          >
        </div>
        
        <h1 class="display-4 fw-bold mb-3" style="letter-spacing: -0.03em;">
          <span style="color: var(--ink);">TRACK &</span><br>
          <span style="color: var(--neon-green); text-shadow: 0 0 20px rgba(127, 255, 0, 0.5);">FIELD</span>
        </h1>
        
        <p class="lead mb-4" style="color: var(--ink-muted); font-size: 1.25rem;">
          Riverview, Florida's premier youth & adult track program.<br>
          <strong style="color: var(--electric-purple);">Train. Compete. Dominate.</strong>
        </p>
        
        <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start mb-5">
          <a href="/registration" class="btn btn-primary btn-lg px-5 py-3" style="font-weight: 600; box-shadow: 0 0 25px rgba(127, 255, 0, 0.4);">
            ⚡ Join Now
          </a>
          <a href="/schedule" class="btn btn-outline-secondary btn-lg px-4 py-3" style="border-color: var(--electric-purple); color: var(--electric-purple);">
            View Schedule
          </a>
        </div>
        
        {{-- Stats with neon glow --}}
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
          <div class="position-absolute w-100 h-100" style="top: 20px; left: 20px; background: linear-gradient(135deg, var(--neon-green) 0%, var(--electric-purple) 100%); border-radius: var(--radius-lg); opacity: 0.3; filter: blur(20px);"></div>
          <img
            src="/assets/images/hero/track-sunset.svg"
            alt="Asylum Made Track & Field - Riverview, Florida"
            class="w-100 position-relative"
            style="border-radius: var(--radius-lg); border: 2px solid var(--border);"
            loading="eager"
          >
        </div>
      </div>
      
    </div>
  </div>
  
  {{-- Neon bottom border --}}
  <div class="position-absolute w-100" style="bottom: 0; left: 0; height: 4px; background: linear-gradient(90deg, var(--neon-green) 0%, var(--electric-purple) 100%); box-shadow: 0 0 20px rgba(127, 255, 0, 0.5);"></div>
</section>

{{-- Why Asylum Made --}}
<section class="py-6 position-relative">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-lg-8 text-center">
        <span class="badge mb-3" style="background: linear-gradient(135deg, var(--neon-green), var(--electric-purple)); color: #000; font-size: 0.75rem; padding: 0.5rem 1rem;">WHY ASYLUM MADE</span>
        <h2 class="display-6 fw-bold mb-3">
          Built for <span style="color: var(--neon-green); text-shadow: 0 0 15px rgba(127, 255, 0, 0.4);">Athletes</span> of All Levels
        </h2>
        <p class="lead" style="color: var(--ink-muted);">
          From first-time runners to competitive athletes, we develop champions through proper training, technique, and community.
        </p>
      </div>
    </div>
    
    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0" style="background: var(--surface-soft); border-left: 4px solid var(--neon-green) !important;">
          <div class="card-body text-center py-4">
            <div class="mb-3" style="font-size: 2.5rem;">🏃‍♂️</div>
            <h3 class="h5 fw-bold mb-2">All Ages</h3>
            <p class="text-muted small mb-0">Youth (6-18) and Masters (19+) programs</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0" style="background: var(--surface-soft); border-left: 4px solid var(--electric-purple) !important;">
          <div class="card-body text-center py-4">
            <div class="mb-3" style="font-size: 2.5rem;">⚡</div>
            <h3 class="h5 fw-bold mb-2">Proven Training</h3>
            <p class="text-muted small mb-0">Experienced coaches in all events</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0" style="background: var(--surface-soft); border-left: 4px solid var(--neon-green) !important;">
          <div class="card-body text-center py-4">
            <div class="mb-3" style="font-size: 2.5rem;">🏆</div>
            <h3 class="h5 fw-bold mb-2">Compete</h3>
            <p class="text-muted small mb-0">Regular meets and time trials</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0" style="background: var(--surface-soft); border-left: 4px solid var(--electric-purple) !important;">
          <div class="card-body text-center py-4">
            <div class="mb-3" style="font-size: 2.5rem;">💪</div>
            <h3 class="h5 fw-bold mb-2">Community</h3>
            <p class="text-muted small mb-0">Supportive team environment</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Events Overview --}}
<section class="py-6" style="background: var(--surface-soft);">
  <div class="container">
    <div class="row mb-5">
      <div class="col text-center">
        <h2 class="display-6 fw-bold mb-2">Track & Field <span style="color: var(--electric-purple);">Events</span></h2>
        <p style="color: var(--ink-muted);">Full event program for every athlete</p>
      </div>
    </div>

    <div class="row g-4">
      @php
        $events = [
          ['name' => 'Sprints', 'desc' => '100m, 200m, 400m', 'color' => '#7FFF00', 'icon' => '⚡'],
          ['name' => 'Distance', 'desc' => '800m, 1600m, 3200m', 'color' => '#8A2BE2', 'icon' => '🏃'],
          ['name' => 'Hurdles', 'desc' => '100mH, 110mH, 300mH', 'color' => '#7FFF00', 'icon' => '🏔'],
          ['name' => 'Long Jump', 'desc' => 'Long jump & triple jump', 'color' => '#8A2BE2', 'icon' => '⬆'],
          ['name' => 'High Jump', 'desc' => 'Fosbury flop technique', 'color' => '#7FFF00', 'icon' => '🎯'],
          ['name' => 'Throws', 'desc' => 'Shot put, discus, javelin', 'color' => '#8A2BE2', 'icon' => '💪'],
        ];
      @endphp
      
      @foreach ($events as $event)
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 border-0 event-card" style="background: var(--surface); transition: all 0.3s ease;">
            <div class="card-body d-flex align-items-center">
              <div class="me-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, {{ $event['color'] }}22 0%, {{ $event['color'] }}44 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.75rem; border: 1px solid {{ $event['color'] }}66;">
                {{ $event['icon'] }}
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
      <a href="/events" class="btn btn-outline-secondary px-4" style="border-color: var(--neon-green); color: var(--neon-green);">
        View All Events →
      </a>
    </div>
  </div>
</section>

{{-- Age Divisions with Dynamic Layout --}}
<section class="py-6">
  <div class="container">
    <div class="row align-items-center mb-5">
      <div class="col-lg-6">
        <span class="badge mb-3" style="background: var(--electric-purple); color: #fff;">DIVISIONS</span>
        <h2 class="display-6 fw-bold">
          Age <span style="color: var(--electric-purple); text-shadow: 0 0 15px rgba(138, 43, 226, 0.5);">Divisions</span>
        </h2>
      </div>
      <div class="col-lg-6 text-lg-end">
        <p style="color: var(--ink-muted);">Compete with athletes your age</p>
      </div>
    </div>
    
    <div class="row g-3">
      <div class="col-6 col-md-4 col-lg-2">
        <div class="card h-100 border-0 text-center" style="background: linear-gradient(180deg, var(--surface-soft) 0%, var(--surface) 100%); border: 1px solid var(--border) !important;">
          <div class="card-body py-4">
            <div class="stat-number" style="font-size: 2rem;">6-8</div>
            <div class="small fw-semibold" style="color: var(--neon-green);">Bantam</div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-2">
        <div class="card h-100 border-0 text-center" style="background: linear-gradient(180deg, var(--surface-soft) 0%, var(--surface) 100%); border: 1px solid var(--border) !important;">
          <div class="card-body py-4">
            <div class="stat-number" style="font-size: 2rem;">9-10</div>
            <div class="small fw-semibold" style="color: var(--electric-purple);">Midget</div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-2">
        <div class="card h-100 border-0 text-center" style="background: linear-gradient(180deg, var(--surface-soft) 0%, var(--surface) 100%); border: 1px solid var(--border) !important;">
          <div class="card-body py-4">
            <div class="stat-number" style="font-size: 2rem;">11-12</div>
            <div class="small fw-semibold" style="color: var(--neon-green);">Youth</div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-2">
        <div class="card h-100 border-0 text-center" style="background: linear-gradient(180deg, var(--surface-soft) 0%, var(--surface) 100%); border: 1px solid var(--border) !important;">
          <div class="card-body py-4">
            <div class="stat-number" style="font-size: 2rem;">13-14</div>
            <div class="small fw-semibold" style="color: var(--electric-purple);">Intermediate</div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-2">
        <div class="card h-100 border-0 text-center" style="background: linear-gradient(180deg, var(--surface-soft) 0%, var(--surface) 100%); border: 1px solid var(--border) !important;">
          <div class="card-body py-4">
            <div class="stat-number" style="font-size: 2rem;">15-18</div>
            <div class="small fw-semibold" style="color: var(--neon-green);">Young Adult</div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4 col-lg-2">
        <div class="card h-100 border-0 text-center" style="background: linear-gradient(135deg, var(--neon-green) 0%, var(--electric-purple) 100%); color: #000;">
          <div class="card-body py-4">
            <div class="stat-number" style="font-size: 2rem; color: #000; text-shadow: none;">19+</div>
            <div class="small fw-bold" style="color: #000;">Masters</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- CTA Section --}}
<section class="py-6 position-relative overflow-hidden" style="background: linear-gradient(135deg, #111 0%, #1a1a1a 100%);">
  {{-- Glow effects --}}
  <div class="position-absolute w-100 h-100" style="top: 0; left: 0; pointer-events: none;">
    <div class="position-absolute" style="top: -50%; left: -10%; width: 400px; height: 400px; background: radial-gradient(circle, rgba(127, 255, 0, 0.15) 0%, transparent 70%); filter: blur(60px);"></div>
    <div class="position-absolute" style="bottom: -30%; right: -10%; width: 300px; height: 300px; background: radial-gradient(circle, rgba(138, 43, 226, 0.15) 0%, transparent 70%); filter: blur(60px);"></div>
  </div>
  
  <div class="container position-relative">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <h2 class="display-5 fw-bold mb-3" style="color: var(--ink);">
          Ready to <span style="color: var(--neon-green); text-shadow: 0 0 20px rgba(127, 255, 0, 0.5);">Compete?</span>
        </h2>
        <p class="lead mb-4" style="color: var(--ink-muted);">
          Join Asylum Made Track & Field. Learn proper technique, build fitness, and dominate the competition.
        </p>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
          <a href="/registration" class="btn btn-primary btn-lg px-5 py-3" style="font-weight: 600; font-size: 1.1rem; box-shadow: 0 0 30px rgba(127, 255, 0, 0.5);">
            ⚡ Register Now
          </a>
          <a href="/contact" class="btn btn-outline-secondary btn-lg px-4 py-3" style="border-color: var(--electric-purple); color: var(--electric-purple);">
            Contact Us
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Quick Links with Hover Effects --}}
<section class="py-6">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4">
        <a href="/schedule" class="card h-100 text-decoration-none border-0 quick-link-card" style="background: var(--surface-soft); transition: all 0.3s ease;">
          <div class="card-body text-center py-5">
            <div class="mb-3" style="width: 80px; height: 80px; margin: 0 auto; background: linear-gradient(135deg, var(--neon-green) 0%, var(--neon-green-dark) 100%); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
              </svg>
            </div>
            <h3 class="h5 fw-bold mb-2">Meet Schedule</h3>
            <p style="color: var(--ink-muted);" class="small mb-0">Upcoming meets and events</p>
          </div>
        </a>
      </div>
      <div class="col-md-4">
        <a href="/results" class="card h-100 text-decoration-none border-0 quick-link-card" style="background: var(--surface-soft); transition: all 0.3s ease;">
          <div class="card-body text-center py-5">
            <div class="mb-3" style="width: 80px; height: 80px; margin: 0 auto; background: linear-gradient(135deg, var(--electric-purple) 0%, var(--electric-purple-hover) 100%); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2">
                <path d="M12 20V10"></path>
                <path d="M18 20V4"></path>
                <path d="M6 20v-4"></path>
              </svg>
            </div>
            <h3 class="h5 fw-bold mb-2">Results & Times</h3>
            <p style="color: var(--ink-muted);" class="small mb-0">Meet results and personal records</p>
          </div>
        </a>
      </div>
      <div class="col-md-4">
        <a href="/about" class="card h-100 text-decoration-none border-0 quick-link-card" style="background: var(--surface-soft); transition: all 0.3s ease;">
          <div class="card-body text-center py-5">
            <div class="mb-3" style="width: 80px; height: 80px; margin: 0 auto; background: linear-gradient(135deg, var(--neon-green) 0%, var(--electric-purple) 100%); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="16" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12.01" y2="8"></line>
              </svg>
            </div>
            <h3 class="h5 fw-bold mb-2">About Us</h3>
            <p style="color: var(--ink-muted);" class="small mb-0">Learn more about our program</p>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>

{{-- Location Section --}}
<section class="py-6" style="background: var(--surface-soft);">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-md-6">
        <div class="position-relative">
          <div class="position-absolute w-100 h-100" style="top: 15px; left: 15px; background: linear-gradient(135deg, var(--electric-purple) 0%, var(--neon-green) 100%); border-radius: var(--radius-lg); opacity: 0.2; filter: blur(15px);"></div>
          <img
            src="/assets/images/hero/pit-area.svg"
            alt="Track & field facilities at Asylum Made"
            class="w-100 position-relative"
            style="border-radius: var(--radius-lg); border: 1px solid var(--border);"
            loading="lazy"
          >
        </div>
      </div>
      <div class="col-md-6">
        <span class="badge mb-3" style="background: var(--neon-green); color: #000;">LOCATION</span>
        <h2 class="h3 fw-bold mb-3">
          Training in <span style="color: var(--neon-green);">Riverview</span>, Florida
        </h2>
        <p style="color: var(--ink-muted);" class="mb-4">
          We train at local track facilities. Practices are held Tuesday and Thursday evenings with Saturday morning meets during the season.
        </p>
        <div class="d-flex flex-column gap-3">
          <div class="d-flex align-items-center">
            <div style="width: 48px; height: 48px; background: linear-gradient(135deg, var(--neon-green) 0%, var(--neon-green-dark) 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
            </div>
            <div>
              <div class="fw-semibold">Riverview, Florida</div>
              <div class="small" style="color: var(--ink-muted);">Hillsborough County</div>
            </div>
          </div>
          <div class="d-flex align-items-center">
            <div style="width: 48px; height: 48px; background: linear-gradient(135deg, var(--electric-purple) 0%, var(--electric-purple-hover) 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
            </div>
            <div>
              <div class="fw-semibold">Practice Schedule</div>
              <div class="small" style="color: var(--ink-muted);">Tue/Thu 6PM • Sat 9AM</div>
            </div>
          </div>
          <div class="d-flex align-items-center">
            <div style="width: 48px; height: 48px; background: linear-gradient(135deg, var(--neon-green) 0%, var(--electric-purple) 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
              </svg>
            </div>
            <div>
              <div class="fw-semibold">All Welcome</div>
              <div class="small" style="color: var(--ink-muted);">All ages and skill levels</div>
            </div>
          </div>
        </div>
        <a href="/contact" class="btn btn-primary mt-4 px-4" style="box-shadow: 0 0 20px rgba(127, 255, 0, 0.3);">
          Get Directions →
        </a>
      </div>
    </div>
  </div>
</section>

{{-- Add hover styles --}}
@push('styles')
<style>
  .event-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 30px rgba(127, 255, 0, 0.15);
    border: 1px solid var(--neon-green) !important;
  }
  
  .quick-link-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 30px rgba(138, 43, 226, 0.15);
  }
  
  .quick-link-card:hover h3 {
    color: var(--neon-green);
  }
  
  .min-vh-75 {
    min-height: 75vh;
  }
  
  @media (max-width: 992px) {
    .min-vh-75 {
      min-height: auto;
    }
  }
</style>
@endpush

@endsection