<footer style="background-color: var(--secondary); color: white;">
  <div class="container py-5">
    <div class="row g-4">
      <div class="col-md-4">
        <div class="d-flex align-items-center mb-3">
          <img src="/assets/images/icons/logo.svg" alt="Asylum Made Track" height="32" class="me-2">
        </div>
        <p class="small mb-2" style="color: rgba(255,255,255,0.8);">
          Saturday night racing in Riverview, Florida. Local track league focused on fair competition and family atmosphere.
        </p>
        <p class="small mb-0" style="color: var(--accent);">
          Gates open 4PM • Racing 7PM
        </p>
      </div>

      <div class="col-6 col-md-2">
        <h6 class="fw-semibold mb-3" style="color: var(--accent);">Racing</h6>
        <ul class="list-unstyled small">
          <li class="mb-2"><a href="/schedule" style="color: rgba(255,255,255,0.8);">Schedule</a></li>
          <li class="mb-2"><a href="/results" style="color: rgba(255,255,255,0.8);">Results</a></li>
          <li class="mb-2"><a href="/standings" style="color: rgba(255,255,255,0.8);">Standings</a></li>
          <li class="mb-2"><a href="/rules" style="color: rgba(255,255,255,0.8);">Rules</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-2">
        <h6 class="fw-semibold mb-3" style="color: var(--accent);">Teams</h6>
        <ul class="list-unstyled small">
          <li class="mb-2"><a href="/teams" style="color: rgba(255,255,255,0.8);">Team Directory</a></li>
          <li class="mb-2"><a href="/drivers" style="color: rgba(255,255,255,0.8);">Drivers</a></li>
          <li class="mb-2"><a href="/registration" style="color: rgba(255,255,255,0.8);">Register</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-2">
        <h6 class="fw-semibold mb-3" style="color: var(--accent);">Info</h6>
        <ul class="list-unstyled small">
          <li class="mb-2"><a href="/about" style="color: rgba(255,255,255,0.8);">About</a></li>
          <li class="mb-2"><a href="/services" style="color: rgba(255,255,255,0.8);">Operations</a></li>
          <li class="mb-2"><a href="/contact" style="color: rgba(255,255,255,0.8);">Contact</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-2">
        <h6 class="fw-semibold mb-3" style="color: var(--accent);">Connect</h6>
        <ul class="list-unstyled small">
          <li class="mb-2"><a href="#" style="color: rgba(255,255,255,0.8);">Facebook</a></li>
          <li class="mb-2"><a href="#" style="color: rgba(255,255,255,0.8);">Instagram</a></li>
          <li class="mb-2"><a href="#" style="color: rgba(255,255,255,0.8);">YouTube</a></li>
        </ul>
      </div>
    </div>

    {{-- Racing stripe accent --}}
    <div class="row mt-4 pt-4" style="border-top: 1px solid rgba(255,255,255,0.1);">
      <div class="col-md-6">
        <p class="small mb-0" style="color: rgba(255,255,255,0.6);">
          © {{ date('Y') }} Asylum Made Track. All rights reserved.
        </p>
      </div>
      <div class="col-md-6 text-md-end">
        <p class="small mb-0" style="color: rgba(255,255,255,0.6);">
          <a href="/privacy" style="color: rgba(255,255,255,0.6);">Privacy</a> ·
          <a href="/terms" style="color: rgba(255,255,255,0.6);">Terms</a>
        </p>
      </div>
    </div>
  </div>

  {{-- Racing stripe --}}
  <div style="height: 4px; background: linear-gradient(90deg, var(--primary) 0%, var(--accent) 50%, var(--primary) 100%);"></div>
</footer>