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
                  <option value="driver" {{ old('role') === 'driver' ? 'selected' : '' }}>Athlete</option>
                  <option value="team_manager" {{ old('role') === 'team_manager' ? 'selected' : '' }}>Team Manager</option>
                  <option value="official" {{ old('role') === 'official' ? 'selected' : '' }}>Official</option>
                  <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="team_id" class="form-label">Team</label>
                <select id="team_id" name="team_id" class="form-select">
                  <option value="">No Team</option>
                  @foreach($teams as $team)
                  <option value="{{ $team->id }}" {{ old('team_id') == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                  @endforeach
                </select>
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