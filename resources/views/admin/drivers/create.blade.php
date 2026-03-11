@extends('layouts.app')

@section('title', 'Add Athlete — Admin')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <h1 class="h4 fw-bold mb-4">Add New Athlete</h1>

            <form action="{{ route('admin.drivers.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="row g-3">
                <div class="col-md-6">
                  <label for="first_name" class="form-label">First Name *</label>
                  <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                </div>

                <div class="col-md-6">
                  <label for="last_name" class="form-label">Last Name *</label>
                  <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                </div>

                <div class="col-md-6">
                  <label for="nickname" class="form-label">Nickname</label>
                  <input type="text" id="nickname" name="nickname" class="form-control" value="{{ old('nickname') }}">
                  <div class="form-text">Racing nickname (optional)</div>
                </div>

                <div class="col-md-6">
                  <label for="team_id" class="form-label">Team *</label>
                  <select id="team_id" name="team_id" class="form-select" required>
                    <option value="">Select Team</option>
                    @foreach($teams as $team)
                      <option value="{{ $team->id }}" {{ old('team_id') == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-6">
                  <label for="user_id" class="form-label">Linked User Account</label>
                  <select id="user_id" name="user_id" class="form-select">
                    <option value="">None (unlinked)</option>
                    @foreach($users as $user)
                      <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                  </select>
                  <div class="form-text">Link to user account for self-service</div>
                </div>

                <div class="col-md-6">
                  <label for="hometown" class="form-label">Hometown</label>
                  <input type="text" id="hometown" name="hometown" class="form-control" value="{{ old('hometown') }}" placeholder="City, State">
                </div>

                <div class="col-12">
                  <hr class="my-3">
                  <h5 class="fw-bold">License & Medical</h5>
                </div>

                <div class="col-md-6">
                  <label for="license_number" class="form-label">License Number</label>
                  <input type="text" id="license_number" name="license_number" class="form-control" value="{{ old('license_number') }}">
                </div>

                <div class="col-md-6">
                  <label for="license_expires" class="form-label">License Expiration</label>
                  <input type="date" id="license_expires" name="license_expires" class="form-control" value="{{ old('license_expires') }}">
                </div>

                <div class="col-md-6">
                  <label for="medical_expires" class="form-label">Medical Certificate Expiration</label>
                  <input type="date" id="medical_expires" name="medical_expires" class="form-control" value="{{ old('medical_expires') }}">
                </div>

                <div class="col-12">
                  <hr class="my-3">
                  <h5 class="fw-bold">Profile</h5>
                </div>

                <div class="col-md-6">
                  <label for="profile_photo" class="form-label">Profile Photo</label>
                  <input type="file" id="profile_photo" name="profile_photo" class="form-control" accept="image/*">
                  <div class="form-text">Max 2MB. JPG, PNG, or GIF.</div>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Status</label>
                  <div class="form-check">
                    <input type="checkbox" id="is_active" name="is_active" class="form-check-input" checked>
                    <label for="is_active" class="form-check-label">Active (can register for events)</label>
                  </div>
                </div>

                <div class="col-12">
                  <label for="bio" class="form-label">Biography</label>
                  <textarea id="bio" name="bio" class="form-control" rows="3">{{ old('bio') }}</textarea>
                </div>
              </div>

              <div class="mt-4">
                <button type="submit" class="btn btn-primary">Create Athlete</button>
                <a href="{{ route('admin.drivers.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection