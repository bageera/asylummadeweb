@extends('layouts.app')

@section('title', 'Manage Users — Admin')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h1 class="h3 fw-bold">Users</h1>
            <p class="text-muted mb-0">Manage user accounts and roles.</p>
          </div>
          <a href="{{ route('admin.users.create') }}" class="btn btn-primary">+ Add User</a>
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
                <th>Role</th>
                <th>Team</th>
                <th>Status</th>
                <th class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($users as $user)
              <tr>
                <td>
                  <div class="fw-semibold">{{ $user->name }}</div>
                </td>
                <td>{{ $user->email }}</td>
                <td>
                  @if($user->role === 'admin')
                  <span class="badge bg-danger">Admin</span>
                  @elseif($user->role === 'official')
                  <span class="badge bg-info">Official</span>
                  @elseif($user->role === 'team_manager')
                  <span class="badge bg-primary">Team Manager</span>
                  @else
                  <span class="badge bg-secondary">Athlete</span>
                  @endif
                </td>
                <td>{{ $user->team?->name ?? '—' }}</td>
                <td>
                  @if($user->email_verified_at)
                  <span class="badge bg-success">Verified</span>
                  @else
                  <span class="badge bg-warning">Unverified</span>
                  @endif
                </td>
                <td class="text-end">
                  <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-secondary me-1">Edit</a>
                  @if($user->id !== auth()->id())
                  <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this user?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                  </form>
                  @endif
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center py-4 text-muted">No users yet.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{ $users->links() }}
  </div>
</div>

@endsection