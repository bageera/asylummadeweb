<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top">
  <div class="container">

    {{-- Brand --}}
    <a class="navbar-brand fw-semibold" href="/">
      asylummadetrack
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
          <a class="nav-link" href="/schedule">Schedule &amp; Results</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/rules">Rules &amp; Classes</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/services">League Operations</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/registration">Registration</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/about">About</a>
        </li>

        <li class="nav-item ms-lg-2">
          <a class="btn btn-dark btn-sm px-3" href="/contact">
            Contact
          </a>
        </li>

      </ul>
    </div>

  </div>
</nav>
