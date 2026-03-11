@extends('layouts.app')

@section('title', 'Add User — Admin')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <h1 class="h4 fw-bold mb-4">Add New User</h1>

            <form action="{{ route('admin.users.store') }}" method="POST">
              @csrf

              <div class="mb-3">
                <label for="name" class="form-label">Full Name *</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Email *</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Password *</label>
                <input type="password" id="password" name="password" class="form-control" required>
                <div class="form-text">Minimum 8 characters.</div>
              </div>

              <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password *</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="role" class="form-label">Role *</label>
                <select id="role" name="role" class="form-select" required>
                  <optgroup label="Administration">
                    <option value="super_user" {{ old('role') === 'super_user' ? 'selected' : '' }}>Super User (Full Access)</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrator</option>
                    <option value="official" {{ old('role') === 'official' ? 'selected' : '' }}>Track Official</option>
                  </optgroup>
                  <optgroup label="Teams">
                    <option value="team_owner" {{ old('role') === 'team_owner' ? 'selected' : '' }}>Team Owner</option>
                    <option value="driver" {{ old('role') === 'driver' ? 'selected' : '' }}>Driver</option>
                  </optgroup>
                </select>
                <div class="form-text">
                  <strong>Super User:</strong> Full system access<br>
                  <strong>Administrator:</strong> Manage seasons, events, teams, users<br>
                  <strong>Track Official:</strong> Manage events and results<br>
                  <strong>Team Owner:</strong> Manage team and drivers<br>
                  <strong>Driver:</strong> Register for events, view results
                </div>
              </div>

              <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone') }}">
              </div>

              <div class="mb-3">
                <label for="emergency_contact" class="form-label">Emergency Contact</label>
                <input type="text" id="emergency_contact" name="emergency_contact" class="form-control" value="{{ old('emergency_contact') }}">
              </div>

              <div class="mb-3">
                <label for="emergency_phone" class="form-label">Emergency Phone</label>
                <input type="tel" id="emergency_phone" name="emergency_phone" class="form-control" value="{{ old('emergency_phone') }}">
              </div>

              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Create User</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection