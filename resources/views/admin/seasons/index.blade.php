@extends('layouts.app')

@section('title', 'Manage Seasons — Admin')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h1 class="h3 fw-bold">Seasons</h1>
            <p class="text-muted mb-0">Manage racing seasons and points systems.</p>
          </div>
          <a href="{{ route('admin.seasons.create') }}" class="btn btn-primary">+ Add Season</a>
        </div>
      </div>
    </div>

    <div class="card border-0 shadow-sm">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table mb-0">
            <thead>
              <tr>
                <th>Season</th>
                <th>Year</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($seasons as $season)
              <tr>
                <td>
                  <a href="{{ route('admin.seasons.edit', $season->id) }}" class="fw-semibold">{{ $season->name }}</a>
                  @if($season->is_current)
                  <span class="badge bg-primary ms-1">Current</span>
                  @endif
                </td>
                <td>{{ $season->year }}</td>
                <td>{{ $season->start_date?->format('M j, Y') ?? '—' }}</td>
                <td>{{ $season->end_date?->format('M j, Y') ?? '—' }}</td>
                <td>
                  @if($season->status === 'active')
                  <span class="badge bg-success">Active</span>
                  @elseif($season->status === 'completed')
                  <span class="badge bg-secondary">Completed</span>
                  @else
                  <span class="badge bg-secondary">{{ $season->status }}</span>
                  @endif
                </td>
                <td class="text-end">
                  <a href="{{ route('admin.seasons.edit', $season->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center py-4 text-muted">No seasons yet. <a href="{{ route('admin.seasons.create') }}">Add the first season</a>.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{ $seasons->links() }}
  </div>
</div>

@endsection