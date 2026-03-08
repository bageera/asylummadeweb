@extends('layouts.app')

@section('title', 'Add Team — Admin')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <h1 class="h4 fw-bold mb-4">Add New Team</h1>

            <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="row g-3">
                <div class="col-md-6">
                  <label for="name" class="form-label">Team Name *</label>
                  <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                  @error('name')
                  <div class="text-danger small">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-6">
                  <label for="slug" class="form-label">Slug *</label>
                  <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug') }}" required>
                  <div class="form-text">URL-friendly identifier (e.g., "riverview-tigers")</div>
                </div>

                <div class="col-md-6">
                  <label for="city" class="form-label">City</label>
                  <input type="text" id="city" name="city" class="form-control" value="{{ old('city') }}">
                </div>

                <div class="col-md-6">
                  <label for="state" class="form-label">State</label>
                  <input type="text" id="state" name="state" class="form-control" value="{{ old('state') }}">
                </div>

                <div class="col-md-6">
                  <label for="contact_name" class="form-label">Contact Name</label>
                  <input type="text" id="contact_name" name="contact_name" class="form-control" value="{{ old('contact_name') }}">
                </div>

                <div class="col-md-6">
                  <label for="contact_email" class="form-label">Contact Email</label>
                  <input type="email" id="contact_email" name="contact_email" class="form-control" value="{{ old('contact_email') }}">
                </div>

                <div class="col-12">
                  <label for="contact_phone" class="form-label">Contact Phone</label>
                  <input type="tel" id="contact_phone" name="contact_phone" class="form-control" value="{{ old('contact_phone') }}">
                </div>

                <div class="col-12">
                  <label for="logo" class="form-label">Team Logo</label>
                  <input type="file" id="logo" name="logo" class="form-control" accept="image/*">
                </div>
              </div>

              <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Create Team</button>
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