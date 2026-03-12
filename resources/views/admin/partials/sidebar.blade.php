{{-- Admin Sidebar Navigation --}}
<aside class="admin-sidebar">
  <div class="list-group list-group-flush">
    
    {{-- Dashboard --}}
    <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <i class="bi bi-speedometer2 me-2"></i> Dashboard
    </a>
    
    <div class="list-group-item bg-light fw-bold text-muted small">LEAGUE MANAGEMENT</div>
    
    {{-- Events --}}
    <a href="{{ route('admin.events.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
      <i class="bi bi-calendar-event me-2"></i> Events
      <span class="badge bg-primary ms-auto">{{ \App\Models\Event::count() }}</span>
    </a>
    
    {{-- Seasons --}}
    <a href="{{ route('admin.seasons.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.seasons.*') ? 'active' : '' }}">
      <i class="bi bi-calendar3 me-2"></i> Seasons
      <span class="badge bg-secondary ms-auto">{{ \App\Models\Season::count() }}</span>
    </a>
    
    {{-- Teams --}}
    <a href="{{ route('admin.teams.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.teams.*') ? 'active' : '' }}">
      <i class="bi bi-people-fill me-2"></i> Teams
      <span class="badge bg-success ms-auto">{{ \App\Models\Team::count() }}</span>
    </a>
    
    {{-- Athletes --}}
    <a href="{{ route('admin.drivers.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.drivers.*') ? 'active' : '' }}">
      <i class="bi bi-person-badge me-2"></i> Athletes
      <span class="badge bg-info ms-auto">{{ \App\Models\Driver::count() }}</span>
    </a>
    
    {{-- Registrations --}}
    <a href="{{ route('admin.registrations.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.registrations.*') ? 'active' : '' }}">
      <i class="bi bi-card-checklist me-2"></i> Meet Registrations
      <span class="badge bg-danger ms-auto">{{ \App\Models\Registration::count() }}</span>
    </a>
    
    <div class="list-group-item bg-light fw-bold text-muted small">BUSINESS OPERATIONS</div>
    
    {{-- Sponsors --}}
    <a href="{{ route('admin.sponsors.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.sponsors.*') ? 'active' : '' }}">
      <i class="bi bi-star-fill me-2"></i> Sponsors
      <span class="badge bg-warning text-dark ms-auto">{{ \App\Models\Sponsor::count() }}</span>
    </a>
    
    {{-- Waivers --}}
    <a href="{{ route('admin.waivers.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.waivers.*') ? 'active' : '' }}">
      <i class="bi bi-file-earmark-text me-2"></i> Waivers
      <span class="badge bg-danger ms-auto">{{ \App\Models\WaiverTemplate::count() }}</span>
    </a>
    
    <div class="list-group-item bg-light fw-bold text-muted small">ADMINISTRATION</div>
    
    {{-- Users --}}
    <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
      <i class="bi bi-person-gear me-2"></i> Users
      <span class="badge bg-dark ms-auto">{{ \App\Models\User::count() }}</span>
    </a>
    
  </div>
  
  {{-- Quick Actions --}}
  <div class="p-3 border-top">
    <div class="fw-bold text-muted small mb-2">QUICK ACTIONS</div>
    <div class="d-grid gap-2">
      <a href="{{ route('admin.events.create') }}" class="btn btn-sm btn-primary">
        <i class="bi bi-plus me-1"></i> Add Event
      </a>
      <a href="{{ route('admin.teams.create') }}" class="btn btn-sm btn-success">
        <i class="bi bi-plus me-1"></i> Add Team
      </a>
      <a href="{{ route('admin.drivers.create') }}" class="btn btn-sm btn-info">
        <i class="bi bi-plus me-1"></i> Add Athlete
      </a>
    </div>
  </div>
</aside>

<style>
.admin-sidebar {
  position: sticky;
  top: 1rem;
  background: var(--surface, #fff);
  border-radius: 0.5rem;
  box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
  overflow: hidden;
}

.admin-sidebar .list-group-item {
  border-left: none;
  border-right: none;
  padding: 0.75rem 1rem;
  display: flex;
  align-items: center;
}

.admin-sidebar .list-group-item:first-child {
  border-top: none;
}

.admin-sidebar .list-group-item:last-child {
  border-bottom: none;
}

.admin-sidebar .list-group-item.active {
  background-color: var(--primary, #0d6efd);
  border-color: var(--primary, #0d6efd);
  color: #fff;
}

.admin-sidebar .list-group-item .badge {
  font-size: 0.7rem;
}
</style>