@extends('layouts.app')

@section('title', 'Manage Teams — Admin')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h1 class="h3 fw-bold">Teams</h1>
            <p class="text-muted mb-0">Manage teams in the league.</p>
          </div>
          <a href="{{ route('admin.teams.create') }}" class="btn btn-primary">+ Add Team</a>
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
                <th>Location</th>
                <th>Contact</th>
                <th>Athletes</th>
                <th>Status</th>
                <th class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($teams as $team)
              <tr>
                <td>
                  <a href="{{ route('admin.teams.show', $team->id) }}" class="fw-semibold">{{ $team->name }}</a>
                </td>
                <td>{{ $team->city }}{{ $team->city && $team->state ? ', ' : '' }}{{ $team->state }}</td>
                <td>
                  @if($team->primary_contact_email)
                  <a href="mailto:{{ $team->primary_contact_email }}">{{ $team->primary_contact_email }}</a>
                  @else
                    <span class="text-muted">—</span>
                  @endif
                </td>
                <td>{{ $team->drivers->count() }}</td>
                <td>
                  <span class="badge {{ $team->is_active ? 'bg-success' : 'bg-secondary' }}">
                    {{ $team->is_active ? 'Active' : 'Inactive' }}
                  </span>
                </td>
                <td class="text-end">
                  <a href="{{ route('admin.teams.edit', $team->id) }}" class="btn btn-sm btn-outline-secondary me-1">Edit</a>
                  <form action="{{ route('admin.teams.destroy', $team->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this team?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                  </form>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center py-4 text-muted">No teams yet. <a href="{{ route('admin.teams.create') }}">Add the first team</a>.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{ $teams->links() }}
  </div>
</div>

@endsection