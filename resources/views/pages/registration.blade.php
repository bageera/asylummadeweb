@extends('layouts.app')

@section('title', 'Register — Asylum Made Track')

@section('meta_description')
Register to compete in track & field events at Asylum Made Track in Riverview, Florida.
@endsection

@section('content')

<section class="py-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <h1 class="h3 fw-bold mb-2">Event Registration</h1>
        <p style="color: var(--muted);">Register to compete in an upcoming event.</p>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <form action="{{ route('registration.store') }}" method="POST">
              @csrf

              {{-- Participant Information --}}
              <h2 class="h5 fw-bold mb-3">Participant Information</h2>

              <div class="row g-3 mb-4">
                <div class="col-md-6">
                  <label for="first_name" class="form-label">First Name *</label>
                  <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                  @error('first_name')
                  <div class="text-danger small">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="last_name" class="form-label">Last Name *</label>
                  <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                  @error('last_name')
                  <div class="text-danger small">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="email" class="form-label">Email *</label>
                  <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                  @error('email')
                  <div class="text-danger small">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="phone" class="form-label">Phone *</label>
                  <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" required>
                  @error('phone')
                  <div class="text-danger small">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="date_of_birth" class="form-label">Date of Birth *</label>
                  <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
                  @error('date_of_birth')
                  <div class="text-danger small">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="team_id" class="form-label">Team</label>
                  <select id="team_id" name="team_id" class="form-select">
                    <option value="">No Team (Independent)</option>
                    @foreach($teams ?? [] as $team)
                    <option value="{{ $team->id }}" {{ old('team_id') == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              {{-- Emergency Contact --}}
              <h2 class="h5 fw-bold mb-3">Emergency Contact</h2>

              <div class="row g-3 mb-4">
                <div class="col-md-6">
                  <label for="emergency_contact_name" class="form-label">Contact Name *</label>
                  <input type="text" id="emergency_contact_name" name="emergency_contact_name" class="form-control" value="{{ old('emergency_contact_name') }}" required>
                </div>
                <div class="col-md-6">
                  <label for="emergency_contact_phone" class="form-label">Contact Phone *</label>
                  <input type="tel" id="emergency_contact_phone" name="emergency_contact_phone" class="form-control" value="{{ old('emergency_contact_phone') }}" required>
                </div>
              </div>

              {{-- Event & Class Selection --}}
              <h2 class="h5 fw-bold mb-3">Event & Class</h2>

              <div class="row g-3 mb-4">
                <div class="col-md-6">
                  <label for="event_id" class="form-label">Select Event *</label>
                  <select id="event_id" name="event_id" class="form-select" required>
                    <option value="">Choose an event</option>
                    @foreach($events ?? [] as $event)
                    <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>
                      {{ $event->name }} — {{ $event->event_date?->format('M j, Y') ?? 'TBD' }}
                    </option>
                    @endforeach
                  </select>
                  @error('event_id')
                  <div class="text-danger small">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="vehicle_class_id" class="form-label">Competition Class *</label>
                  <select id="vehicle_class_id" name="vehicle_class_id" class="form-select" required>
                    <option value="">Choose a class</option>
                    @foreach($classes ?? [] as $class)
                    <option value="{{ $class->id }}" {{ old('vehicle_class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                    @endforeach
                  </select>
                  @error('vehicle_class_id')
                  <div class="text-danger small">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              {{-- Agreements --}}
              <h2 class="h5 fw-bold mb-3">Agreements</h2>

              <div class="mb-4">
                <div class="form-check mb-2">
                  <input type="checkbox" id="agree_rules" name="agree_rules" class="form-check-input" value="1" required>
                  <label for="agree_rules" class="form-check-label">
                    I have read and agree to the <a href="{{ route('rules') }}" target="_blank">league rules</a> *
                  </label>
                </div>
                <div class="form-check mb-2">
                  <input type="checkbox" id="agree_waiver" name="agree_waiver" class="form-check-input" value="1" required>
                  <label for="agree_waiver" class="form-check-label">
                    I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#waiverModal">liability waiver</a> *
                  </label>
                </div>
                <div class="form-check">
                  <input type="checkbox" id="agree_safety" name="agree_safety" class="form-check-input" value="1" required>
                  <label for="agree_safety" class="form-check-label">
                    I confirm I have the required safety equipment *
                  </label>
                </div>
              </div>

              {{-- Minor Waiver --}}
              <div class="alert alert-info mb-4">
                <strong>Note for minors:</strong> Participants under 18 must have a parent or legal guardian sign all required documents in person before the event.
              </div>

              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-lg">Submit Registration</button>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        {{-- Requirements --}}
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white">
            <h3 class="h5 fw-bold mb-0">Requirements</h3>
          </div>
          <div class="card-body">
            <ul class="list-unstyled mb-0">
              <li class="mb-2">✓ Completed registration form</li>
              <li class="mb-2">✓ Signed liability waiver</li>
              <li class="mb-2">✓ Safety equipment verification</li>
              <li class="mb-2">✓ Vehicle inspection (if applicable)</li>
              <li>✓ Compliance with league rules</li>
            </ul>
          </div>
        </div>

        {{-- Contact Info --}}
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white">
            <h3 class="h5 fw-bold mb-0">Questions?</h3>
          </div>
          <div class="card-body">
            <p class="text-muted mb-3">Contact the league if you have questions about registration or eligibility.</p>
            <a href="{{ route('contact') }}" class="btn btn-outline-secondary w-100">Contact Us</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Waiver Modal --}}
<div class="modal fade" id="waiverModal" tabindex="-1" aria-labelledby="waiverModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="waiverModalLabel">Liability Waiver</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
        <h6>ASSUMPTION OF RISK AND RELEASE OF LIABILITY</h6>
        <p>By participating in events at Asylum Made Track, I acknowledge and agree that:</p>
        <ol>
          <li>I am voluntarily participating in motorsports activities which involve inherent risks of injury, death, and property damage.</li>
          <li>I assume all risks associated with participation, including but not limited to vehicle operation, track conditions, and the actions of other participants.</li>
          <li>I release Asylum Made Track, its officers, employees, agents, and volunteers from any and all liability for injuries, damages, or losses arising from my participation.</li>
          <li>I agree to comply with all track rules, safety regulations, and official instructions.</li>
          <li>I certify that I am physically and mentally capable of participating safely.</li>
        </ol>
        <p><strong>FOR MINORS:</strong> Parents or legal guardians must sign additional documentation in person prior to participation.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection