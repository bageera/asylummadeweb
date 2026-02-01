@extends('layouts.app')

@section('title', 'Registration — Asylum Made Track')

@section('meta_description')
Participant registration information for the Asylum Made Track local league in Riverview, Florida, including requirements and next steps.
@endsection

@section('content')

{{-- Page Header --}}
<section class="py-5 border-bottom">
  <div class="container">
    <h1 class="h3 fw-semibold mb-3">Registration</h1>
    <p class="text-muted max-w-lg">
      Registration ensures that all participants meet league requirements and
      that events are run safely and consistently. This page outlines what is
      required to participate.
    </p>
  </div>
</section>

{{-- Eligibility --}}
<section class="py-5">
  <div class="container">

    <h2 class="h5 fw-semibold mb-3">Who can register</h2>

    <div class="row g-4">
      <div class="col-md-6">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <p class="mb-0">
              Registration is open to drivers who meet the league’s age, safety,
              and vehicle requirements for their chosen class.
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <p class="mb-0">
              Minors must have a parent or legal guardian complete and approve
              all required documentation prior to participation.
            </p>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

{{-- Requirements --}}
<section class="py-5 bg-light border-top border-bottom">
  <div class="container">

    <h2 class="h5 fw-semibold mb-4">Registration requirements</h2>

    <div class="row g-4">

      @foreach ([
        'Completed registration form',
        'Signed liability waiver',
        'Proof of required safety equipment',
        'Vehicle inspection for applicable class',
        'Compliance with league rules and conduct standards'
      ] as $req)

      <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <p class="mb-0">{{ $req }}</p>
          </div>
        </div>
      </div>

      @endforeach

    </div>

  </div>
</section>

{{-- Process --}}
<section class="py-5">
  <div class="container">

    <h2 class="h5 fw-semibold mb-3">Registration process</h2>

    <div class="row">
      <div class="col-lg-8">
        <ol class="text-muted">
          <li>Review the league rules and class requirements.</li>
          <li>Confirm eligibility for the intended competition class.</li>
          <li>Contact the league to request registration materials.</li>
          <li>Submit required documentation before the event deadline.</li>
          <li>Receive confirmation prior to race day.</li>
        </ol>
      </div>
    </div>

  </div>
</section>

{{-- Important Notes --}}
<section class="py-5 bg-light border-top">
  <div class="container">

    <h2 class="h6 fw-semibold mb-2">Important notes</h2>
    <p class="text-muted max-w-lg mb-0">
      Registration does not guarantee placement in an event if capacity limits
      are reached. Late or incomplete submissions may delay approval.
    </p>

  </div>
</section>

{{-- Callout --}}
<section class="py-5 border-top">
  <div class="container d-flex flex-column flex-lg-row justify-content-between align-items-center gap-3">
    <div>
      <h3 class="h5 fw-semibold mb-1">Ready to get started?</h3>
      <p class="text-muted mb-0">
        Contact the league to request registration materials or clarify eligibility.
      </p>
    </div>
    <a href="/contact" class="btn btn-dark px-4">Contact the league</a>
  </div>
</section>

@endsection
