<section class="py-5 bg-light">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <h2 class="h4 fw-semibold">Core capabilities</h2>
        <p class="text-muted mb-0">
          Services are treated as flexible capabilities, not rigid offerings.
        </p>
      </div>
    </div>

    <div class="row g-4">
      @foreach ([
        'Strategy & Planning',
        'Design & Architecture',
        'Implementation',
        'Operations & Support',
        'Optimization & Advisory',
        'Migration & Modernization'
      ] as $capability)
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
              <h3 class="h6 fw-semibold">{{ $capability }}</h3>
              <p class="text-muted small mb-0">
                Structured support that adapts to the needs of each engagement.
              </p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
