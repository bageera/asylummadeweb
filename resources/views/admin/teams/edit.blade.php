@extends('layouts.app')

@section('title', 'Edit Team — Admin')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <h1 class="h4 fw-bold mb-4">Edit Team: {{ $team->name }}</h1>

            <form action="{{ route('admin.teams.update', $team->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="row g-3">
                <div class="col-md-6">
                  <label for="name" class="form-label">Team Name *</label>
                  <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $team->name) }}" required>
                </div>

                <div class="col-md-6">
                  <label for="slug" class="form-label">Slug *</label>
                  <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', $team->slug) }}" required>
                </div>

                <div class="col-md-6">
                  <label for="city" class="form-label">City</label>
                  <input type="text" id="city" name="city" class="form-control" value="{{ old('city', $team->city) }}">
                </div>

                <div class="col-md-6">
                  <label for="state" class="form-label">State</label>
                  <input type="text" id="state" name="state" class="form-control" value="{{ old('state', $team->state) }}">
                </div>

                <div class="col-md-6">
                  <label for="established_year" class="form-label">Established Year</label>
                  <input type="number" id="established_year" name="established_year" class="form-control" value="{{ old('established_year', $team->established_year) }}" min="1900" max="{{ date('Y') }}">
                </div>

                <div class="col-md-6">
                  <label for="primary_contact_email" class="form-label">Contact Email</label>
                  <input type="email" id="primary_contact_email" name="primary_contact_email" class="form-control" value="{{ old('primary_contact_email', $team->primary_contact_email) }}">
                </div>

                <div class="col-md-6">
                  <label for="primary_contact_phone" class="form-label">Contact Phone</label>
                  <input type="tel" id="primary_contact_phone" name="primary_contact_phone" class="form-control" value="{{ old('primary_contact_phone', $team->primary_contact_phone) }}">
                </div>

                <div class="col-12">
                  <label for="bio" class="form-label">Team Bio</label>
                  <textarea id="bio" name="bio" class="form-control" rows="3">{{ old('bio', $team->bio) }}</textarea>
                </div>

                <div class="col-12">
                  <label for="logo_path" class="form-label">Team Logo</label>
                  @if($team->logo_path)
                  <div class="mb-2">
                    <img src="{{ asset('storage/' . $team->logo_path) }}" alt="{{ $team->name }}" style="max-height: 80px;">
                  </div>
                  @endif
                  <input type="file" id="logo_path" name="logo_path" class="form-control" accept="image/*">
                </div>

                <div class="col-12">
                  <div class="form-check">
                    <input type="checkbox" id="is_active" name="is_active" class="form-check-input" value="1" {{ $team->is_active ? 'checked' : '' }}>
                    <label for="is_active" class="form-check-label">Active</label>
                  </div>
                </div>
              </div>

              <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.teams.index') }}" class="btn btn-outline-secondary">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection