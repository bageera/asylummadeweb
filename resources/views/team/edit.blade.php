@extends('layouts.app')

@section('title', 'Edit Team Info — Team Dashboard')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <h1 class="h4 fw-bold mb-4">Edit Team Info</h1>

            <form action="{{ route('team.update') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="mb-3">
                <label class="form-label">Team Name</label>
                <input type="text" class="form-control" value="{{ $team->name }}" disabled>
                <div class="form-text">Team name can only be changed by an administrator.</div>
              </div>

              <div class="row g-3">
                <div class="col-md-6">
                  <label for="city" class="form-label">City</label>
                  <input type="text" id="city" name="city" class="form-control" value="{{ old('city', $team->city) }}">
                </div>

                <div class="col-md-6">
                  <label for="state" class="form-label">State</label>
                  <input type="text" id="state" name="state" class="form-control" value="{{ old('state', $team->state) }}">
                </div>
              </div>

              <div class="mt-3">
                <label for="contact_name" class="form-label">Contact Name</label>
                <input type="text" id="contact_name" name="contact_name" class="form-control" value="{{ old('contact_name', $team->contact_name) }}">
              </div>

              <div class="mt-3">
                <label for="contact_email" class="form-label">Contact Email</label>
                <input type="email" id="contact_email" name="contact_email" class="form-control" value="{{ old('contact_email', $team->contact_email) }}">
              </div>

              <div class="mt-3">
                <label for="contact_phone" class="form-label">Contact Phone</label>
                <input type="tel" id="contact_phone" name="contact_phone" class="form-control" value="{{ old('contact_phone', $team->contact_phone) }}">
              </div>

              <div class="mt-3">
                <label for="logo" class="form-label">Team Logo</label>
                @if($team->logo)
                <div class="mb-2">
                  <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}" style="max-height: 80px;">
                </div>
                @endif
                <input type="file" id="logo" name="logo" class="form-control" accept="image/*">
              </div>

              <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('team.dashboard') }}" class="btn btn-outline-secondary">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection