@extends('layouts.app')

@section('title', '{{ $team->name }} — Team Details')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h1 class="h3 fw-bold">{{ $team->name }}</h1>
            @if($team->city || $team->state)
            <p class="text-muted mb-0">{{ $team->city }}{{ $team->city && $team->state ? ', ' : '' }}{{ $team->state }}</p>
            @endif
          </div>
          <a href="{{ route('admin.teams.edit', $team->id) }}" class="btn btn-primary">Edit Team</a>
        </div>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
          <div class="card-body text-center">
            @if($team->logo_path)
            <img src="{{ asset('storage/' . $team->logo_path) }}" alt="{{ $team->name }}" class="img-fluid mb-3" style="max-height: 150px;">
            @else
            <div class="bg-secondary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px; font-size: 2.5rem;">
              {{ Str::substr($team->name, 0, 1) }}
            </div>
            @endif
            <h2 class="h4 mb-1">{{ $team->name }}</h2>
            @if($team->established_year)
            <p class="text-muted mb-2">Est. {{ $team->established_year }}</p>
            @endif
            <span class="badge {{ $team->is_active ? 'bg-success' : 'bg-secondary' }}">
              {{ $team->is_active ? 'Active' : 'Inactive' }}
            </span>
          </div>
        </div>

        <div class="card border-0 shadow-sm mt-3">
          <div class="card-header bg-white">
            <h3 class="h6 fw-bold mb-0">Contact Info</h3>
          </div>
          <div class="card-body">
            @if($team->primary_contact_email)
            <p class="mb-2">
              <strong>Email:</strong><br>
              <a href="mailto:{{ $team->primary_contact_email }}">{{ $team->primary_contact_email }}</a>
            </p>
            @endif
            @if($team->primary_contact_phone)
            <p class="mb-0">
              <strong>Phone:</strong><br>
              {{ $team->primary_contact_phone }}
            </p>
            @endif
            @if(!$team->primary_contact_email && !$team->primary_contact_phone)
            <p class="text-muted mb-0">No contact info provided.</p>
            @endif
          </div>
        </div>
      </div>

      <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white">
            <h3 class="h6 fw-bold mb-0">About</h3>
          </div>
          <div class="card-body">
            @if($team->bio)
            <p>{{ $team->bio }}</p>
            @else
            <p class="text-muted mb-0">No bio provided.</p>
            @endif
          </div>
        </div>

        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h3 class="h6 fw-bold mb-0">Athletes ({{ $team->drivers->count() }})</h3>
            <a href="{{ route('admin.drivers.create', ['team_id' => $team->id]) }}" class="btn btn-sm btn-primary">+ Add Athlete</a>
          </div>
          <div class="card-body p-0">
            @if($team->drivers->count() > 0)
            <div class="table-responsive">
              <table class="table mb-0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($team->drivers as $driver)
                  <tr>
                    <td>
                      <a href="{{ route('admin.drivers.show', $driver->id) }}">
                        @if($driver->nickname)
                          "{{ $driver->nickname }}" {{ $driver->last_name }}
                        @else
                          {{ $driver->full_name }}
                        @endif
                      </a>
                    </td>
                    <td>
                      @if($driver->is_active ?? true)
                      <span class="badge bg-success">Active</span>
                      @else
                      <span class="badge bg-secondary">Inactive</span>
                      @endif
                    </td>
                    <td class="text-end">
                      <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @else
            <div class="p-4 text-center text-muted">
              No athletes assigned to this team yet.
              <br>
              <a href="{{ route('admin.drivers.create', ['team_id' => $team->id]) }}" class="btn btn-primary btn-sm mt-2">+ Add Athlete</a>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection