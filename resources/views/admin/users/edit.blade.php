@extends('layouts.app')

@section('title', 'Edit User — Admin')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <h1 class="h4 fw-bold mb-4">Edit User: {{ $user->name }}</h1>

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
              @csrf
              @method('PUT')

              <div class="mb-3">
                <label for="name" class="form-label">Full Name *</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Email *</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
              </div>

              <div class="mb-3">
                <label for="role" class="form-label">Role *</label>
                <select id="role" name="role" class="form-select" required>
                  <option value="driver" {{ $user->role === 'driver' ? 'selected' : '' }}>Athlete</option>
                  <option value="team_manager" {{ $user->role === 'team_manager' ? 'selected' : '' }}>Team Manager</option>
                  <option value="official" {{ $user->role === 'official' ? 'selected' : '' }}>Official</option>
                  <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="team_id" class="form-label">Team</label>
                <select id="team_id" name="team_id" class="form-select">
                  <option value="">No Team</option>
                  @foreach($teams as $team)
                  <option value="{{ $team->id }}" {{ $user->team_id == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" id="password" name="password" class="form-control">
                <div class="form-text">Leave blank to keep current password.</div>
              </div>

              <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
              </div>

              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save Changes</button>
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