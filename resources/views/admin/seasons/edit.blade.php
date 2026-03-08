@extends('layouts.app')

@section('title', 'Edit Season — Admin')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <h1 class="h4 fw-bold mb-4">Edit Season: {{ $season->name }}</h1>

            <form action="{{ route('admin.seasons.update', $season->id) }}" method="POST">
              @csrf
              @method('PUT')

              <div class="mb-3">
                <label for="name" class="form-label">Season Name *</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $season->name) }}" required>
              </div>

              <div class="mb-3">
                <label for="slug" class="form-label">Slug *</label>
                <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', $season->slug) }}" required>
              </div>

              <div class="mb-3">
                <label for="year" class="form-label">Year *</label>
                <input type="number" id="year" name="year" class="form-control" value="{{ old('year', $season->year) }}" required>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="start_date" class="form-label">Start Date *</label>
                  <input type="date" id="start_date" name="start_date" class="form-control" value="{{ old('start_date', $season->start_date?->format('Y-m-d')) }}" required>
                </div>
                <div class="col-md-6">
                  <label for="end_date" class="form-label">End Date *</label>
                  <input type="date" id="end_date" name="end_date" class="form-control" value="{{ old('end_date', $season->end_date?->format('Y-m-d')) }}" required>
                </div>
              </div>

              <div class="mb-3">
                <label for="points_system" class="form-label">Points System *</label>
                <select id="points_system" name="points_system" class="form-select" required>
                  <option value="standard" {{ $season->points_system === 'standard' ? 'selected' : '' }}>Standard (10-8-6-5-4-3-2-1)</option>
                  <option value="f1_style" {{ $season->points_system === 'f1_style' ? 'selected' : '' }}>F1 Style (25-18-15-12-10-8-6-4-2-1)</option>
                  <option value="nascar_style" {{ $season->points_system === 'nascar_style' ? 'selected' : '' }}>NASCAR Style (40-35-32-30-28...)</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select">
                  <option value="active" {{ $season->status === 'active' ? 'selected' : '' }}>Active</option>
                  <option value="completed" {{ $season->status === 'completed' ? 'selected' : '' }}>Completed</option>
                  <option value="archived" {{ $season->status === 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
              </div>

              <div class="mb-3">
                <div class="form-check">
                  <input type="checkbox" id="is_current" name="is_current" class="form-check-input" value="1" {{ $season->is_current ? 'checked' : '' }}>
                  <label for="is_current" class="form-check-label">Current Season</label>
                </div>
              </div>

              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.seasons.index') }}" class="btn btn-outline-secondary">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection