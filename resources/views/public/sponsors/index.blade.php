@extends('layouts.app')

@section('title', 'Our Sponsors — Asylum Made Track & Field')

@section('meta_description')
Thank you to our sponsors who support Asylum Made Track & Field. View our Platinum, Gold, Silver, and Bronze sponsors.
@endsection

@section('content')

<section class="py-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <h1 class="h2 fw-bold mb-2">Our Sponsors</h1>
        <p style="color: var(--muted);">Thank you to the businesses and individuals who support our league.</p>
      </div>
    </div>

    @forelse($sponsors as $tier => $sponsorsList)
      @php
        $tierName = App\Models\Sponsor::TIERS[$tier] ?? 'Sponsors';
        $tierColors = [
          4 => 'bg-secondary text-white',
          3 => 'bg-warning text-dark',
          2 => 'bg-light border',
          1 => '',
        ];
        $tierBg = $tierColors[$tier] ?? 'bg-light';
        $borderClass = $tier === 1 ? 'border' : '';
        $badgeStyle = $tier === 1 ? 'background-color: #cd7f32; color: white;' : '';
      @endphp

      <div class="row mb-5">
        <div class="col-12">
          <div class="d-flex align-items-center mb-3">
            <span class="badge {{ $tierBg }} px-3 py-2" @if($tier === 1) style="{!! $badgeStyle !!}" @endif>
              {{ $tierName }}
            </span>
          </div>
        </div>

        @foreach($sponsorsList as $sponsor)
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 border-0 shadow-sm {{ $borderClass }}" @if($tier === 1) style="border-color: #cd7f32 !important;" @endif>
              @if($sponsor->logo_path)
                <div class="card-img-top text-center py-4" style="background: var(--surface-soft);">
                  <img src="{{ asset('storage/' . $sponsor->logo_path) }}" alt="{{ $sponsor->name }}" class="img-fluid" style="max-height: 120px; max-width: 80%;">
                </div>
              @endif
              <div class="card-body">
                <h3 class="h5 fw-bold">{{ $sponsor->name }}</h3>
                @if($sponsor->description)
                  <p class="text-muted small">{{ Str::limit($sponsor->description, 150) }}</p>
                @endif
                @if($sponsor->website)
                  <a href="{{ $sponsor->website }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-box-arrow-up-right me-1"></i> Visit Website
                  </a>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @empty
      <div class="text-center py-5">
        <p class="text-muted">No sponsors to display yet. Check back soon!</p>
      </div>
    @endforelse

    <div class="row mt-5">
      <div class="col">
        <div class="card border-0 shadow-sm bg-light">
          <div class="card-body text-center py-5">
            <h3 class="h5 fw-bold mb-3">Become a Sponsor</h3>
            <p class="text-muted mb-4">Interested in sponsoring Asylum Made Track & Field?<br>Contact us to learn about sponsorship opportunities.</p>
            <a href="{{ route('contact') }}" class="btn btn-primary">Contact Us</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection