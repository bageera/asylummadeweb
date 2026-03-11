@extends('layouts.app')

@section('title', 'Edit Waiver Template — Admin')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h1 class="h4 fw-bold mb-0">Edit: {{ $waiver->name }}</h1>
              <a href="{{ route('admin.waivers.signed', $waiver) }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-file-text me-1"></i> View Signed ({{ $waiver->waivers()->count() }})
              </a>
            </div>

            <form action="{{ route('admin.waivers.update', $waiver) }}" method="POST">
              @csrf
              @method('PUT')

              <div class="row g-3">
                <div class="col-md-8">
                  <label for="name" class="form-label">Template Name *</label>
                  <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $waiver->name) }}" required>
                </div>

                <div class="col-md-4">
                  <label for="version" class="form-label">Version</label>
                  <input type="text" id="version" name="version" class="form-control" value="{{ old('version', $waiver->version) }}">
                </div>

                <div class="col-12">
                  <label for="content" class="form-label">Waiver Content *</label>
                  <p class="text-muted small">Use Markdown or HTML. Available variables: <code>{name}</code>, <code>{date}</code>, <code>{event_name}</code></p>
                  <textarea id="content" name="content" class="form-control" rows="12" required>{{ old('content', $waiver->content) }}</textarea>
                </div>

                <div class="col-md-4">
                  <label for="valid_for_days" class="form-label">Valid For (Days)</label>
                  <input type="number" id="valid_for_days" name="valid_for_days" class="form-control" value="{{ old('valid_for_days', $waiver->valid_for_days) }}">
                  <div class="form-text">0 = no expiry</div>
                </div>

                <div class="col-md-4">
                  <label class="form-label">Signature Options</label>
                  <div class="form-check">
                    <input type="checkbox" id="requires_signature" name="requires_signature" class="form-check-input" {{ $waiver->requires_signature ? 'checked' : '' }}>
                    <label for="requires_signature" class="form-check-label">Requires Signature</label>
                  </div>
                  <div class="form-check mt-2">
                    <input type="checkbox" id="requires_parent_signature" name="requires_parent_signature" class="form-check-input" {{ $waiver->requires_parent_signature ? 'checked' : '' }}>
                    <label for="requires_parent_signature" class="form-check-label">Requires Parent Signature</label>
                  </div>
                </div>

                <div class="col-md-4">
                  <label class="form-label">Status</label>
                  <div class="form-check">
                    <input type="checkbox" id="is_active" name="is_active" class="form-check-input" {{ $waiver->is_active ? 'checked' : '' }}>
                    <label for="is_active" class="form-check-label">Active</label>
                  </div>
                </div>
              </div>

              <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Template</button>
                <a href="{{ route('admin.waivers.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
              </div>
            </form>
          </div>
        </div>

        {{-- Preview --}}
        <div class="card border-0 shadow-sm mt-4">
          <div class="card-header bg-light">
            <h3 class="h5 fw-bold mb-0">Preview</h3>
          </div>
          <div class="card-body">
            <div class="bg-light p-4" style="font-size: 0.95rem; line-height: 1.6;">
              {!! \Illuminate\Support\Str::markdown($waiver->content) !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection