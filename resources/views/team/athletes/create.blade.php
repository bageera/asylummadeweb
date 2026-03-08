@extends('layouts.app')

@section('title', 'Add Athlete — Team Dashboard')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <h1 class="h4 fw-bold mb-4">Add New Athlete</h1>

            <form action="{{ route('team.athletes.store') }}" method="POST">
              @csrf

              <div class="mb-3">
                <label for="name" class="form-label">Full Name *</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Email Address *</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                <div class="form-text">A temporary password will be sent to this email.</div>
              </div>

              <div class="mb-3">
                <label for="date_of_birth" class="form-label">Date of Birth</label>
                <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
              </div>

              <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone') }}">
              </div>

              <div class="mb-3">
                <label for="emergency_contact" class="form-label">Emergency Contact Name</label>
                <input type="text" id="emergency_contact" name="emergency_contact" class="form-control" value="{{ old('emergency_contact') }}">
              </div>

              <div class="mb-3">
                <label for="emergency_phone" class="form-label">Emergency Contact Phone</label>
                <input type="tel" id="emergency_phone" name="emergency_phone" class="form-control" value="{{ old('emergency_phone') }}">
              </div>

              <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Add Athlete</button>
                <a href="{{ route('team.athletes') }}" class="btn btn-outline-secondary">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection