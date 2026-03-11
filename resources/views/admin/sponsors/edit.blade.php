@extends('layouts.app')

@section('title', 'Edit Sponsor — Admin')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <h1 class="h4 fw-bold mb-4">Edit Sponsor: {{ $sponsor->name }}</h1>

            <form action="{{ route('admin.sponsors.update', $sponsor) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="row g-3">
                <div class="col-md-8">
                  <label for="name" class="form-label">Sponsor Name *</label>
                  <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $sponsor->name) }}" required>
                </div>

                <div class="col-md-4">
                  <label for="tier" class="form-label">Tier *</label>
                  <select id="tier" name="tier" class="form-select" required>
                    <option value="1" {{ $sponsor->tier == 1 ? 'selected' : '' }}>Bronze</option>
                    <option value="2" {{ $sponsor->tier == 2 ? 'selected' : '' }}>Silver</option>
                    <option value="3" {{ $sponsor->tier == 3 ? 'selected' : '' }}>Gold</option>
                    <option value="4" {{ $sponsor->tier == 4 ? 'selected' : '' }}>Platinum</option>
                  </select>
                </div>

                <div class="col-12">
                  <label for="description" class="form-label">Description</label>
                  <textarea id="description" name="description" class="form-control" rows="3">{{ old('description', $sponsor->description) }}</textarea>
                </div>

                <div class="col-md-8">
                  <label for="website" class="form-label">Website</label>
                  <input type="url" id="website" name="website" class="form-control" value="{{ old('website', $sponsor->website) }}" placeholder="https://example.com">
                </div>

                <div class="col-md-4">
                  <label for="logo" class="form-label">Logo</label>
                  @if($sponsor->logo_path)
                    <div class="mb-2">
                      <img src="{{ asset('storage/' . $sponsor->logo_path) }}" alt="{{ $sponsor->name }}" style="height: 60px; width: auto;">
                    </div>
                  @endif
                  <input type="file" id="logo" name="logo" class="form-control" accept="image/*">
                  <div class="form-text">Max 5MB. PNG, JPG, or SVG.</div>
                </div>

                <div class="col-md-6">
                  <label for="sort_order" class="form-label">Sort Order</label>
                  <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', $sponsor->sort_order) }}">
                </div>

                <div class="col-md-6">
                  <label class="form-label">Status</label>
                  <div class="form-check">
                    <input type="checkbox" id="is_active" name="is_active" class="form-check-input" {{ $sponsor->is_active ? 'checked' : '' }}>
                    <label for="is_active" class="form-check-label">Active (visible on site)</label>
                  </div>
                </div>

                <div class="col-12">
                  <hr class="my-3">
                  <h5 class="fw-bold">Event Sponsorships</h5>
                  
                  <div id="sponsorships-container">
                    @foreach($sponsor->events as $index => $event)
                      <div class="row g-2 mb-2 sponsorship-row">
                        <div class="col-md-6">
                          <select name="events[]" class="form-select">
                            <option value="">Select Event</option>
                            @foreach($events as $e)
                              <option value="{{ $e->id }}" {{ $e->id == $event->id ? 'selected' : '' }}>{{ $e->name }} ({{ $e->event_date?->format('M j, Y') ?? 'TBD' }})</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-4">
                          <select name="sponsorship_types[]" class="form-select">
                            <option value="general" {{ $event->pivot->sponsorship_type == 'general' ? 'selected' : '' }}>General Sponsor</option>
                            <option value="heat" {{ $event->pivot->sponsorship_type == 'heat' ? 'selected' : '' }}>Heat Sponsor</option>
                            <option value="feature" {{ $event->pivot->sponsorship_type == 'feature' ? 'selected' : '' }}>Feature Sponsor</option>
                            <option value="trophy" {{ $event->pivot->sponsorship_type == 'trophy' ? 'selected' : '' }}>Trophy Sponsor</option>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <button type="button" class="btn btn-outline-danger btn-sm remove-sponsorship"><i class="bi bi-trash"></i></button>
                        </div>
                      </div>
                    @endforeach
                  </div>
                  
                  <button type="button" id="add-sponsorship" class="btn btn-outline-secondary btn-sm mt-2">
                    <i class="bi bi-plus"></i> Add Event
                  </button>
                </div>
              </div>

              <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Sponsor</button>
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
  
  const row = document.createElement('div');
  row.className = 'row g-2 mb-2 sponsorship-row';
  row.innerHTML = `
    <div class="col-md-6">
      <select name="events[]" class="form-select">
        <option value="">Select Event</option>
        @foreach($events as $e)
          <option value="{{ $e->id }}">{{ $e->name }} ({{ $e->event_date?->format('M j, Y') ?? 'TBD' }})</option>
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