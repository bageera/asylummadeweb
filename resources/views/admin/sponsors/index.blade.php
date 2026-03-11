@extends('layouts.app')

@section('title', 'Manage Sponsors — Admin')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h1 class="h3 fw-bold">Sponsors</h1>
            <p class="text-muted mb-0">Manage event and league sponsors.</p>
          </div>
          <a href="{{ route('admin.sponsors.create') }}" class="btn btn-primary">+ Add Sponsor</a>
        </div>
      </div>
    </div>

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    {{-- Tier Legend --}}
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-md-3 mb-2">
            <span class="badge bg-secondary">Platinum</span>
            <span class="text-muted ms-2">Top tier - Featured everywhere</span>
          </div>
          <div class="col-md-3 mb-2">
            <span class="badge bg-warning text-dark">Gold</span>
            <span class="text-muted ms-2">Major sponsor - Event banners</span>
          </div>
          <div class="col-md-3 mb-2">
            <span class="badge bg-light text-dark border">Silver</span>
            <span class="text-muted ms-2">Supporting - Website + flyers</span>
          </div>
          <div class="col-md-3 mb-2">
            <span class="badge bg-orange" style="background-color: #cd7f32;">Bronze</span>
            <span class="text-muted ms-2">Contributor - Website listing</span>
          </div>
        </div>
      </div>
    </div>

    <div class="card border-0 shadow-sm">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table mb-0">
            <thead>
              <tr>
                <th>Logo</th>
                <th>Sponsor</th>
                <th>Tier</th>
                <th>Events</th>
                <th>Status</th>
                <th class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($sponsors as $sponsor)
              <tr>
                <td>
                  @if($sponsor->logo_path)
                    <img src="{{ asset('storage/' . $sponsor->logo_path) }}" alt="{{ $sponsor->name }}" style="height: 40px; width: auto;">
                  @else
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 40px; width: 60px;">
                      <i class="bi bi-image text-muted"></i>
                    </div>
                  @endif
                </td>
                <td>
                  <a href="{{ route('admin.sponsors.edit', $sponsor) }}" class="fw-semibold">{{ $sponsor->name }}</a>
                  @if($sponsor->website)
                    <br><small class="text-muted"><a href="{{ $sponsor->website }}" target="_blank">{{ $sponsor->website }}</a></small>
                  @endif
                </td>
                <td>
                  @if($sponsor->tier === 4)
                    <span class="badge bg-secondary">Platinum</span>
                  @elseif($sponsor->tier === 3)
                    <span class="badge bg-warning text-dark">Gold</span>
                  @elseif($sponsor->tier === 2)
                    <span class="badge bg-light text-dark border">Silver</span>
                  @else
                    <span class="badge" style="background-color: #cd7f32;">Bronze</span>
                  @endif
                </td>
                <td>{{ $sponsor->events->count() }}</td>
                <td>
                  @if($sponsor->is_active)
                    <span class="badge bg-success">Active</span>
                  @else
                    <span class="badge bg-secondary">Inactive</span>
                  @endif
                </td>
                <td class="text-end">
                  <a href="{{ route('admin.sponsors.edit', $sponsor) }}" class="btn btn-sm btn-outline-secondary me-1">Edit</a>
                  <form action="{{ route('admin.sponsors.destroy', $sponsor) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this sponsor?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                  </form>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center py-4 text-muted">No sponsors yet. <a href="{{ route('admin.sponsors.create') }}">Add the first sponsor</a>.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{ $sponsors->links() }}
  </div>
</div>

@endsection