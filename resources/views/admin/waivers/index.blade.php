@extends('layouts.app')

@section('title', 'Manage Waiver Templates — Admin')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h1 class="h3 fw-bold">Waiver Templates</h1>
            <p class="text-muted mb-0">Manage liability waivers and consent forms.</p>
          </div>
          <a href="{{ route('admin.waivers.create') }}" class="btn btn-primary">+ Add Template</a>
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
                <th>Template</th>
                <th>Version</th>
                <th>Validity</th>
                <th>Signed</th>
                <th>Status</th>
                <th class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($templates as $template)
              <tr>
                <td>
                  <a href="{{ route('admin.waivers.edit', $template) }}" class="fw-semibold">{{ $template->name }}</a>
                  @if($template->requires_parent_signature)
                    <br><small class="text-muted"><i class="bi bi-person-badge"></i> Requires parent signature</small>
                  @endif
                </td>
                <td><span class="badge bg-light text-dark">{{ $template->version }}</span></td>
                <td>
                  @if($template->valid_for_days > 0)
                    {{ $template->valid_for_days }} days
                  @else
                    <span class="text-muted">No expiry</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('admin.waivers.signed', $template) }}">{{ $template->waivers_count }} signed</a>
                </td>
                <td>
                  @if($template->is_active)
                    <span class="badge bg-success">Active</span>
                  @else
                    <span class="badge bg-secondary">Inactive</span>
                  @endif
                </td>
                <td class="text-end">
                  <a href="{{ route('admin.waivers.edit', $template) }}" class="btn btn-sm btn-outline-secondary me-1">Edit</a>
                  <a href="{{ route('admin.waivers.export', $template) }}" class="btn btn-sm btn-outline-primary me-1">Export</a>
                  <form action="{{ route('admin.waivers.destroy', $template) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this template and all signed waivers?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                  </form>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center py-4 text-muted">No waiver templates yet. <a href="{{ route('admin.waivers.create') }}">Create the first template</a>.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{ $templates->links() }}
  </div>
</div>

@endsection