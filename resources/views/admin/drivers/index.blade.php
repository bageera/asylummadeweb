@extends('layouts.app')

@section('title', 'Manage Athletes — Admin')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h1 class="h3 fw-bold">Athletes</h1>
            <p class="text-muted mb-0">Manage drivers and athletes in the league.</p>
          </div>
          <a href="{{ route('admin.drivers.create') }}" class="btn btn-primary">+ Add Athlete</a>
        </div>
      </div>
    </div>

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    <div class="card border-0 shadow-sm">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table mb-0">
            <thead>
              <tr>
                <th>Name</th>
                <th>Team</th>
                <th>Hometown</th>
                <th>License</th>
                <th>Medical</th>
                <th>Status</th>
                <th class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($drivers as $driver)
              <tr>
                <td>
                  <a href="{{ route('admin.drivers.show', $driver->id) }}" class="fw-semibold">
                    @if($driver->nickname)
                      "{{ $driver->nickname }}" {{ $driver->last_name }}
                    @else
                      {{ $driver->full_name }}
                    @endif
                  </a>
                  @if($driver->user)
                    <br><small class="text-muted">User: {{ $driver->user->name }}</small>
                  @endif
                </td>
                <td>
                  @if($driver->team)
                    <a href="{{ route('admin.teams.show', $driver->team->id) }}">{{ $driver->team->name }}</a>
                  @else
                    <span class="text-muted">—</span>
                  @endif
                </td>
                <td>{{ $driver->hometown ?? '—' }}</td>
                <td>
                  @if($driver->license_expires)
                    @if($driver->license_valid)
                      <span class="badge bg-success">Valid until {{ $driver->license_expires->format('M Y') }}</span>
    @else
      <span class="badge bg-danger">Expired {{ $driver->license_expires->format('M Y') }}</span>
                    @endif
                  @else
                    <span class="text-muted">—</span>
                  @endif
                </td>
                <td>
                  @if($driver->medical_expires)
                    @if($driver->medical_valid)
                      <span class="badge bg-success">Valid until {{ $driver->medical_expires->format('M Y') }}</span>
                    @else
                      <span class="badge bg-danger">Expired {{ $driver->medical_expires->format('M Y') }}</span>
                    @endif
                  @else
                    <span class="text-muted">—</span>
                  @endif
                </td>
                <td>
                  @if($driver->is_active)
                    <span class="badge bg-success">Active</span>
                  @else
                    <span class="badge bg-secondary">Inactive</span>
                  @endif
                </td>
                <td class="text-end">
                  <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn btn-sm btn-outline-secondary me-1">Edit</a>
                  <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this athlete?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                  </form>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="7" class="text-center py-4 text-muted">No athletes yet. <a href="{{ route('admin.drivers.create') }}">Add the first athlete</a>.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{ $drivers->links() }}
  </div>
</div>

@endsection