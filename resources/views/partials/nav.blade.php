<nav class="navbar navbar-expand-lg sticky-top" style="background-color: var(--surface); border-bottom: 1px solid var(--border);">
  <div class="container">

    {{-- Brand --}}
    <a class="navbar-brand d-flex align-items-center" href="/">
      <img src="/assets/images/icons/logo.png" alt="Asylum Made Track & Field" height="40" class="me-2">
    </a>

    {{-- Mobile toggle --}}
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#mainNav"
      aria-controls="mainNav"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    {{-- Nav links --}}
    <div id="mainNav" class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto gap-lg-3 align-items-lg-center">

        <li class="nav-item">
          <a class="nav-link" href="/schedule">Schedule</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/results">Results</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/standings">Standings</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/sponsors">Sponsors</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/events">Events</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/about">About</a>
        </li>

        @auth
          {{-- Authenticated user menu --}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle me-1"></i>
              {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              @if(auth()->user()->canAccessAdmin())
                <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-gear me-2"></i>Admin Panel</a></li>
                <li><hr class="dropdown-divider"></li>
              @else
                <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                <li><a class="dropdown-item" href="{{ route('profile.index') }}"><i class="bi bi-person me-2"></i>Profile Settings</a></li>
                <li><hr class="dropdown-divider"></li>
              @endif
              <li><a class="dropdown-item" href="{{ route('profile.index') }}"><i class="bi bi-person-gear me-2"></i>Profile Settings</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="dropdown-item text-danger">
                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                  </button>
                </form>
              </li>
            </ul>
          </li>
        @else
          {{-- Guest: Login and Register buttons --}}
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">
              <i class="bi bi-box-arrow-in-right me-1"></i>Login
            </a>
          </li>
          <li class="nav-item ms-lg-2">
            <a class="btn btn-primary btn-sm px-3" href="{{ route('registration') }}">
              Register
            </a>
          </li>
        @endauth

      </ul>
    </div>

  </div>
</nav>