@extends('layouts.app')

@section('title', 'Rules & Regulations — Asylum Made Track')

@section('meta_description')
Official rules and regulations for Asylum Made Track events. Safety requirements, competition classes, and participant responsibilities.
@endsection

@section('content')

<section class="py-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <h1 class="h2 fw-bold mb-2">Rules & Regulations</h1>
        <p style="color: var(--muted);">Official rules for all Asylum Made Track events.</p>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-lg-8">
        {{-- Safety Requirements --}}
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">
            <h2 class="h4 fw-bold mb-3">Safety Requirements</h2>

            <h3 class="h6 fw-bold mt-4">Personal Protective Equipment</h3>
            <ul>
              <li>Helmet (Snell SA2015 or newer, or SFI 31.1 rated)</li>
              <li>Fire-resistant suit (SFI 3.2A/5 or higher)</li>
              <li>Fire-resistant gloves</li>
              <li>Fire-resistant shoes</li>
              <li>Eye protection (goggles or face shield)</li>
            </ul>

            <h3 class="h6 fw-bold mt-4">Vehicle Safety</h3>
            <ul>
              <li>Roll cage meeting SFI specifications</li>
              <li>Fire extinguisher (mounted and accessible)</li>
              <li>Seat belts (5-point harness minimum)</li>
              <li>Window net (driver side)</li>
              <li>Battery cutoff switch (clearly marked)</li>
              <li>Fuel cell (SFI or FIA certified)</li>
            </ul>

            <h3 class="h6 fw-bold mt-4">Track Rules</h3>
            <ul>
              <li>Speed limit in pit area: 5 MPH</li>
              <li>No passengers during competition</li>
              <li>Drivers meeting attendance mandatory</li>
              <li>Red flag: Stop immediately, proceed with caution</li>
              <li>Yellow flag: Slow down, no passing</li>
              <li>Black flag: Report to pit area immediately</li>
            </ul>
          </div>
        </div>

        {{-- Competition Rules --}}
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">
            <h2 class="h4 fw-bold mb-3">Competition Rules</h2>

            <h3 class="h6 fw-bold mt-4">Eligibility</h3>
            <ul>
              <li>Valid driver's license required</li>
              <li>Minimum age: 16 years (with parental consent)</li>
              <li>Vehicle must pass technical inspection</li>
              <li>All entry fees must be paid before competition</li>
            </ul>

            <h3 class="h6 fw-bold mt-4">Classes</h3>
            <p>Competition classes are determined by vehicle type and modification level. See the specific event registration for available classes.</p>

            <h3 class="h6 fw-bold mt-4">Scoring</h3>
            <p>Points are awarded based on finishing position in each heat or feature. The points system may vary by season and event type.</p>

            <h3 class="h6 fw-bold mt-4">Protests</h3>
            <p>All protests must be filed in writing within 30 minutes of the completion of the event, accompanied by a $100 protest fee. The fee will be returned if the protest is upheld.</p>
          </div>
        </div>

        {{-- Code of Conduct --}}
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">
            <h2 class="h4 fw-bold mb-3">Code of Conduct</h2>

            <p>All participants, crew members, and spectators are expected to:</p>
            <ul>
              <li>Treat all participants, officials, and spectators with respect</li>
              <li>Follow all track rules and official instructions</li>
              <li>Refrain from unsafe or unsportsmanlike conduct</li>
              <li>Keep pit areas clean and organized</li>
              <li>Dispose of waste properly (oil, fuel, tires)</li>
              <li>Report any safety concerns to track officials immediately</li>
            </ul>

            <h3 class="h6 fw-bold mt-4">Penalties</h3>
            <p>Violations may result in:</p>
            <ul>
              <li>Warning</li>
              <li>Position penalty</li>
              <li>Disqualification from event</li>
              <li>Suspension from future events</li>
              <li>Permanent ban from track</li>
            </ul>
          </div>
        </div>

        {{-- Waiver --}}
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h2 class="h4 fw-bold mb-3">Liability Waiver</h2>

            <p>By participating in events at Asylum Made Track, all participants acknowledge and agree that:</p>
            <ol>
              <li>Participation in motorsports activities involves inherent risks of injury, death, and property damage.</li>
              <li>Participants assume all risks associated with participation, including but not limited to vehicle operation, track conditions, and the actions of other participants.</li>
              <li>Asylum Made Track, its officers, employees, agents, and volunteers are released from any and all liability for injuries, damages, or losses arising from participation.</li>
              <li>Participants agree to comply with all track rules, safety regulations, and official instructions.</li>
              <li>Participants certify they are physically and mentally capable of participating safely.</li>
            </ol>

            <p class="text-muted small mt-3">
              <strong>For minors:</strong> Participants under 18 must have a parent or legal guardian sign additional documentation in person prior to participation.
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        {{-- Quick Reference --}}
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white">
            <h3 class="h5 fw-bold mb-0">Quick Reference</h3>
          </div>
          <div class="card-body">
            <ul class="list-unstyled mb-0">
              <li class="py-2 border-bottom">✓ Helmet: Snell SA2015+</li>
              <li class="py-2 border-bottom">✓ Fire suit: SFI 3.2A/5+</li>
              <li class="py-2 border-bottom">✓ 5-point harness minimum</li>
              <li class="py-2 border-bottom">✓ Roll cage: SFI spec</li>
              <li class="py-2 border-bottom">✓ Fire extinguisher required</li>
              <li class="py-2">✓ Pit speed: 5 MPH</li>
            </ul>
          </div>
        </div>

        {{-- Contact --}}
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white">
            <h3 class="h5 fw-bold mb-0">Questions?</h3>
          </div>
          <div class="card-body">
            <p class="text-muted mb-3">Contact us if you have questions about rules, eligibility, or safety requirements.</p>
            <a href="{{ route('contact') }}" class="btn btn-outline-secondary w-100">Contact Us</a>
          </div>
        </div>

        {{-- Register CTA --}}
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));">
          <div class="card-body text-white text-center py-4">
            <h3 class="h5 fw-bold mb-2">Ready to Compete?</h3>
            <p class="mb-3">Register for an upcoming event.</p>
            <a href="{{ route('registration') }}" class="btn btn-light">Register Now</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection