@extends('layouts.app')

@section('title', 'Profile Settings — Asylum Made Track & Field')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h1 class="h3 fw-bold mb-4">Profile Settings</h1>
        
        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif
        
        @if($errors->any())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        {{-- Profile Information --}}
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white">
            <h2 class="h5 fw-bold mb-0">Profile Information</h2>
            <p class="text-muted small mb-0">Update your personal information.</p>
          </div>
          <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST">
              @csrf
              @method('PUT')
              
              <div class="row g-3">
                <div class="col-md-12">
                  <label for="name" class="form-label">Full Name</label>
                  <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                </div>
                
                <div class="col-md-12">
                  <label for="email" class="form-label">Email Address</label>
                  <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                </div>
                
                <div class="col-md-6">
                  <label for="phone" class="form-label">Phone Number</label>
                  <input type="tel" name="phone" id="phone" class="form-control" value="{{ $user->phone }}">
                </div>
                
                <div class="col-md-6">
                  <label for="emergency_contact" class="form-label">Emergency Contact</label>
                  <input type="text" name="emergency_contact" id="emergency_contact" class="form-control" value="{{ $user->emergency_contact }}">
                </div>
                
                <div class="col-md-6">
                  <label for="emergency_phone" class="form-label">Emergency Phone</label>
                  <input type="tel" name="emergency_phone" id="emergency_phone" class="form-control" value="{{ $user->emergency_phone }}">
                </div>
              </div>
              
              <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                  <i class="bi bi-check-lg me-1"></i> Save Changes
                </button>
              </div>
            </form>
          </div>
        </div>

        {{-- Change Password --}}
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white">
            <h2 class="h5 fw-bold mb-0">Change Password</h2>
            <p class="text-muted small mb-0">Update your account password.</p>
          </div>
          <div class="card-body">
            <form action="{{ route('profile.password') }}" method="POST">
              @csrf
              @method('PUT')
              
              <div class="row g-3">
                <div class="col-md-12">
                  <label for="current_password" class="form-label">Current Password</label>
                  <input type="password" name="current_password" id="current_password" class="form-control" required>
                </div>
                
                <div class="col-md-6">
                  <label for="password" class="form-label">New Password</label>
                  <input type="password" name="password" id="password" class="form-control" required>
                  <div class="form-text">Minimum 8 characters.</div>
                </div>
                
                <div class="col-md-6">
                  <label for="password_confirmation" class="form-label">Confirm New Password</label>
                  <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                </div>
              </div>
              
              <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                  <i class="bi bi-key me-1"></i> Update Password
                </button>
              </div>
            </form>
          </div>
        </div>

        {{-- Account Role --}}
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white">
            <h2 class="h5 fw-bold mb-0">Account Role</h2>
            <p class="text-muted small mb-0">Your current role and permissions.</p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label text-muted small">Role</label>
                <div class="d-flex align-items-center">
                  @if($user->isSuperUser())
                    <span class="badge bg-danger fs-6">Super User</span>
                  @elseif($user->isAdmin())
                    <span class="badge bg-primary fs-6">Administrator</span>
                  @elseif($user->role === 'official')
                    <span class="badge bg-info fs-6">Track Official</span>
                  @elseif($user->role === 'team_owner')
                    <span class="badge bg-success fs-6">Team Owner</span>
                  @else
                    <span class="badge bg-secondary fs-6">Driver</span>
                  @endif
                </div>
              </div>
              
              @if($user->teams->count() > 0)
              <div class="col-md-6 mb-3">
                <label class="form-label text-muted small">Teams Owned</label>
                <div>
                  @foreach($user->teams as $team)
                    <span class="badge bg-light text-dark me-1">{{ $team->name }}</span>
                  @endforeach
                </div>
              </div>
              @endif
            </div>
            
            <p class="text-muted small mb-0">
              <i class="bi bi-info-circle me-1"></i>
              Role changes can only be made by an administrator.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection