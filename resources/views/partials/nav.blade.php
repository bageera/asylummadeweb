<nav class="navbar navbar-expand-lg sticky-top" style="background-color: var(--surface); border-bottom: 1px solid var(--border-light);">
  <div class="container">

    {{-- Brand --}}
    <a class="navbar-brand d-flex align-items-center" href="/">
      <img src="/assets/images/icons/logo.svg" alt="Asylum Made Track" height="36" class="me-2">
      <span class="fw-bold" style="color: var(--secondary);">asylummadespan class="text-primary">track</span></span>
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
          <a class="nav-link" href="/rules">Rules</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/teams">Teams</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/about">About</a>
        </li>

        <li class="nav-item ms-lg-2">
          <a class="btn btn-primary btn-sm px-3" href="/registration">
            Register
          </a>
        </li>

      </ul>
    </div>

  </div>
</nav>
