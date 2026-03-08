@extends('layouts.app')

@section('title', 'Athletes — Team Dashboard')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h1 class="h3 fw-bold">Athletes</h1>
            <p class="text-muted mb-0">Manage athletes on your team.</p>
          </div>
          <a href="{{ route('team.athletes.create') }}" class="btn btn-primary">+ Add Athlete</a>
        </div>
      </div>
    </div>

    <div class="card border-0 shadow-sm">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table mb-0">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Division</th>
                <th>Status</th>
                <th class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($athletes as $athlete)
              <tr>
                <td>{{ $athlete->name }}</td>
                <td>{{ $athlete->email }}</td>
                <td>{{ $athlete->age_division ?? '—' }}</td>
                <td>
                  <span class="badge {{ $athlete->is_active ?? true ? 'bg-success' : 'bg-secondary' }}">
                    {{ $athlete->is_active ?? true ? 'Active' : 'Inactive' }}
                  </span>
                </td>
                <td class="text-end">
                  <form action="{{ route('team.athletes.destroy', $athlete->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Remove this athlete from your team?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                  </form>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="text-center py-4 text-muted">No athletes yet. <a href="{{ route('team.athletes.create') }}">Add your first athlete</a>.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection