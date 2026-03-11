@extends('layouts.app')

@section('title', 'Signed Waivers — {{ $waiver->name }}')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h1 class="h3 fw-bold">Signed Waivers: {{ $waiver->name }}</h1>
            <p class="text-muted mb-0">Version {{ $waiver->version }} · Valid for {{ $waiver->valid_for_days ?? '∞' }} days</p>
          </div>
          <div>
            <a href="{{ route('admin.waivers.export', $waiver) }}" class="btn btn-outline-primary me-2">
              <i class="bi bi-download me-1"></i> Export CSV
            </a>
            <a href="{{ route('admin.waivers.index') }}" class="btn btn-outline-secondary">Back to Templates</a>
          </div>
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
                <th>User</th>
                <th>Event</th>
                <th>Signed At</th>
                <th>IP Address</th>
                <th>Expires</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse($waivers as $w)
              <tr>
                <td>
                  <div class="fw-semibold">{{ $w->user->name }}</div>
                  <small class="text-muted">{{ $w->user->email }}</small>
                </td>
                <td>{{ $w->event?->name ?? 'General' }}</td>
                <td>{{ $w->signed_at->format('M j, Y g:i A') }}</td>
                <td><code>{{ $w->ip_address }}</code></td>
                <td>
                  @if($w->expires_at)
                    @if($w->isExpired())
                      <span class="text-danger">{{ $w->expires_at->format('M j, Y') }}</span>
                    @else
                      {{ $w->expires_at->format('M j, Y') }}
                    @endif
                  @else
                    <span class="text-muted">Never</span>
                  @endif
                </td>
                <td>
                  @if($w->isValid())
                    <span class="badge bg-success">Valid</span>
                  @elseif($w->isExpired())
                    <span class="badge bg-warning text-dark">Expired</span>
                  @else
                    <span class="badge bg-secondary">Invalid</span>
                  @endif
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center py-4 text-muted">No signed waivers yet.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{ $waivers->links() }}
  </div>
</div>

@endsection