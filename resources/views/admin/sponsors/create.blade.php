@extends('layouts.app')

@section('title', 'Add Sponsor — Admin')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <h1 class="h4 fw-bold mb-4">Add New Sponsor</h1>

            <form action="{{ route('admin.sponsors.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="row g-3">
                <div class="col-md-8">
                  <label for="name" class="form-label">Sponsor Name *</label>
                  <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="col-md-4">
                  <label for="tier" class="form-label">Tier *</label>
                  <select id="tier" name="tier" class="form-select" required>
                    <option value="1" {{ old('tier') == '1' ? 'selected' : '' }}>Bronze</option>
                    <option value="2" {{ old('tier') == '2' ? 'selected' : '' }}>Silver</option>
                    <option value="3" {{ old('tier') == '3' ? 'selected' : '' }}>Gold</option>
                    <option value="4" {{ old('tier') == '4' ? 'selected' : '' }}>Platinum</option>
                  </select>
                </div>

                <div class="col-12">
                  <label for="description" class="form-label">Description</label>
                  <textarea id="description" name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="col-md-8">
                  <label for="website" class="form-label">Website</label>
                  <input type="url" id="website" name="website" class="form-control" value="{{ old('website') }}" placeholder="https://example.com">
                </div>

                <div class="col-md-4">
                  <label for="logo" class="form-label">Logo</label>
                  <input type="file" id="logo" name="logo" class="form-control" accept="image/*">
                  <div class="form-text">Max 5MB. PNG, JPG, or SVG.</div>
                </div>

                <div class="col-md-6">
                  <label for="sort_order" class="form-label">Sort Order</label>
                  <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
                  <div class="form-text">Lower numbers appear first within tier.</div>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Status</label>
                  <div class="form-check">
                    <input type="checkbox" id="is_active" name="is_active" class="form-check-input" checked>
                    <label for="is_active" class="form-check-label">Active (visible on site)</label>
                  </div>
                </div>

                <div class="col-12">
                  <hr class="my-3">
                  <h5 class="fw-bold">Event Sponsorships</h5>
                  <p class="text-muted small">Associate this sponsor with specific events.</p>
                  
                  <div id="sponsorships-container">
                    @if(old('events'))
                      @foreach(old('events') as $index => $eventId)
                        <div class="row g-2 mb-2 sponsorship-row">
                          <div class="col-md-6">
                            <select name="events[]" class="form-select">
                              <option value="">Select Event</option>
                              @foreach($events ?? [] as $event)
                                <option value="{{ $event->id }}" {{ $event->id == $eventId ? 'selected' : '' }}>{{ $event->name }} ({{ $event->event_date?->format('M j, Y') ?? 'TBD' }})</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-4">
                            <select name="sponsorship_types[]" class="form-select">
                              <option value="general">General Sponsor</option>
                              <option value="heat">Heat Sponsor</option>
                              <option value="feature">Feature Sponsor</option>
                              <option value="trophy">Trophy Sponsor</option>
                            </select>
                          </div>
                          <div class="col-md-2">
                            <button type="button" class="btn btn-outline-danger btn-sm remove-sponsorship"><i class="bi bi-trash"></i></button>
                          </div>
                        </div>
                      @endforeach
                    @endif
                  </div>
                  
                  <button type="button" id="add-sponsorship" class="btn btn-outline-secondary btn-sm mt-2">
                    <i class="bi bi-plus"></i> Add Event
                  </button>
                </div>
              </div>

              <div class="mt-4">
                <button type="submit" class="btn btn-primary">Create Sponsor</button>
                <a href="{{ route('admin.sponsors.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.getElementById('add-sponsorship').addEventListener('click', function() {
  const container = document.getElementById('sponsorships-container');
  const index = container.children.length;
  
  const row = document.createElement('div');
  row.className = 'row g-2 mb-2 sponsorship-row';
  row.innerHTML = `
    <div class="col-md-6">
      <select name="events[]" class="form-select">
        <option value="">Select Event</option>
        @foreach($events ?? [] as $event)
          <option value="{{ $event->id }}">{{ $event->name }} ({{ $event->event_date?->format('M j, Y') ?? 'TBD' }})</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-4">
      <select name="sponsorship_types[]" class="form-select">
        <option value="general">General Sponsor</option>
        <option value="heat">Heat Sponsor</option>
        <option value="feature">Feature Sponsor</option>
        <option value="trophy">Trophy Sponsor</option>
      </select>
    </div>
    <div class="col-md-2">
      <button type="button" class="btn btn-outline-danger btn-sm remove-sponsorship"><i class="bi bi-trash"></i></button>
    </div>
  `;
  
  container.appendChild(row);
});

document.addEventListener('click', function(e) {
  if (e.target.classList.contains('remove-sponsorship') || e.target.closest('.remove-sponsorship')) {
    e.target.closest('.sponsorship-row').remove();
  }
});
</script>
@endpush

@endsection