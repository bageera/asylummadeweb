@extends('layouts.app')

@section('title', 'Contact — asylummadetrack')

@section('content')

<section class="py-5 border-bottom">
  <div class="container">
    <h1 class="h3 fw-semibold mb-3">Contact</h1>
    <p class="text-muted max-w-lg">
      Share a brief overview of what you're working on. You'll receive a response
      outlining next steps and expected timing.
    </p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4">

      <div class="col-lg-7">
        <div class="card shadow-sm">
          <div class="card-body">
            <form method="post" action="#">
              @csrf

              <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" required>
              </div>

              <div class="mb-4">
                <label class="form-label">Message</label>
                <textarea rows="5" class="form-control" required></textarea>
              </div>

              <div class="d-flex flex-column flex-sm-row justify-content-between gap-3">
                <small class="text-muted">
                  We respect your time and privacy. Minimal fields by design.
                </small>
                <button type="submit" class="btn btn-dark px-4">
                  Send message
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="card shadow-sm mb-4">
          <div class="card-body">
            <h2 class="h6 fw-semibold">What happens next</h2>
            <p class="text-muted mt-3 mb-0">
              You'll receive a response with clarification questions or a proposed
              next step. There is no automated follow-up or sales pressure.
            </p>
          </div>
        </div>

        <div class="card shadow-sm">
          <div class="card-body">
            <h2 class="h6 fw-semibold">Direct Contact</h2>
            <ul class="list-unstyled mt-3 mb-0">
              <li class="mb-2">
                <strong>General Inquiries:</strong><br>
                <a href="mailto:info@asylummadetrack.com" class="text-decoration-none">info@asylummadetrack.com</a>
              </li>
              <li class="mb-2">
                <strong>Registration:</strong><br>
                <a href="mailto:register@asylummadetrack.com" class="text-decoration-none">register@asylummadetrack.com</a>
              </li>
              <li>
                <strong>Support:</strong><br>
                <a href="mailto:support@asylummadetrack.com" class="text-decoration-none">support@asylummadetrack.com</a>
              </li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

@endsection
