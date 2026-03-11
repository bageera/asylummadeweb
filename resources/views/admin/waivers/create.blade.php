@extends('layouts.app')

@section('title', 'Add Waiver Template — Admin')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <h1 class="h4 fw-bold mb-4">Create Waiver Template</h1>

            <form action="{{ route('admin.waivers.store') }}" method="POST">
              @csrf

              <div class="row g-3">
                <div class="col-md-8">
                  <label for="name" class="form-label">Template Name *</label>
                  <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="e.g., General Liability Waiver" required>
                </div>

                <div class="col-md-4">
                  <label for="version" class="form-label">Version</label>
                  <input type="text" id="version" name="version" class="form-control" value="{{ old('version', '1.0') }}">
                </div>

                <div class="col-12">
                  <label for="content" class="form-label">Waiver Content *</label>
                  <p class="text-muted small">Use Markdown or HTML. Available variables: <code>{name}</code>, <code>{date}</code>, <code>{event_name}</code></p>
                  <textarea id="content" name="content" class="form-control" rows="12" required>{{ old('content') }}</textarea>
                </div>

                <div class="col-md-4">
                  <label for="valid_for_days" class="form-label">Valid For (Days)</label>
                  <input type="number" id="valid_for_days" name="valid_for_days" class="form-control" value="{{ old('valid_for_days', 365) }}">
                  <div class="form-text">0 = no expiry (annual waivers)</div>
                </div>

                <div class="col-md-4">
                  <label class="form-label">Signature Options</label>
                  <div class="form-check">
                    <input type="checkbox" id="requires_signature" name="requires_signature" class="form-check-input" checked>
                    <label for="requires_signature" class="form-check-label">Requires Signature</label>
                  </div>
                  <div class="form-check mt-2">
                    <input type="checkbox" id="requires_parent_signature" name="requires_parent_signature" class="form-check-input" {{ old('requires_parent_signature') ? 'checked' : '' }}>
                    <label for="requires_parent_signature" class="form-check-label">Requires Parent Signature (minors)</label>
                  </div>
                </div>

                <div class="col-md-4">
                  <label class="form-label">Status</label>
                  <div class="form-check">
                    <input type="checkbox" id="is_active" name="is_active" class="form-check-input" checked>
                    <label for="is_active" class="form-check-label">Active (available for signing)</label>
                  </div>
                </div>
              </div>

              <div class="mt-4">
                <button type="submit" class="btn btn-primary">Create Template</button>
                <a href="{{ route('admin.waivers.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
              </div>
            </form>
          </div>
        </div>

        {{-- Sample Template --}}
        <div class="card border-0 shadow-sm mt-4">
          <div class="card-header bg-light">
            <h3 class="h5 fw-bold mb-0">Sample Waiver Template</h3>
          </div>
          <div class="card-body">
            <pre class="bg-light p-3" style="font-size: 0.85rem;">## RELEASE AND WAIVER OF LIABILITY

I, **{name}**, hereby acknowledge and agree that:

1. I am voluntarily participating in track and field activities organized by Asylum Made Track & Field.

2. I understand the inherent risks involved in these activities.

3. I hereby release, waive, and discharge Asylum Made Track & Field, its officers, agents, and employees from any and all liability.

4. This waiver is effective as of **{date}** for event: **{event_name}**.

---

**Electronic Signature:** By typing my full legal name below, I confirm I have read and agree to this waiver.

- Digital Signature: _________________________
- Date: {date}</pre>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection