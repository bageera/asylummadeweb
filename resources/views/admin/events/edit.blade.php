@extends('layouts.app')

@section('title', 'Edit Event — Admin')

@section('content')

<div class="py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <h1 class="h4 fw-bold mb-4">Edit Event: {{ $event->name }}</h1>

            <form action="{{ route('admin.events.update', $event->id) }}" method="POST">
              @csrf
              @method('PUT')

              <div class="row g-3">
                <div class="col-md-8">
                  <label for="name" class="form-label">Event Name *</label>
                  <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $event->name) }}" required>
                </div>

                <div class="col-md-4">
                  <label for="slug" class="form-label">Slug *</label>
                  <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', $event->slug) }}" required>
                </div>

                <div class="col-md-6">
                  <label for="season_id" class="form-label">Season *</label>
                  <select id="season_id" name="season_id" class="form-select" required>
                    @foreach($seasons as $season)
                    <option value="{{ $season->id }}" {{ old('season_id', $event->season_id) == $season->id ? 'selected' : '' }}>
                      {{ $season->name }} ({{ $season->year }})
                    </option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-6">
                  <label for="event_date" class="form-label">Event Date *</label>
                  <input type="date" id="event_date" name="event_date" class="form-control" value="{{ old('event_date', $event->event_date?->format('Y-m-d')) }}" required>
                </div>

                <div class="col-md-4">
                  <label for="gates_open_time" class="form-label">Gates Open</label>
                  <input type="time" id="gates_open_time" name="gates_open_time" class="form-control" value="{{ old('gates_open_time', $event->gates_open_time?->format('H:i')) }}">
                </div>

                <div class="col-md-4">
                  <label for="practice_start_time" class="form-label">Practice Start</label>
                  <input type="time" id="practice_start_time" name="practice_start_time" class="form-control" value="{{ old('practice_start_time', $event->practice_start_time?->format('H:i')) }}">
                </div>

                <div class="col-md-4">
                  <label for="racing_start_time" class="form-label">Racing Start</label>
                  <input type="time" id="racing_start_time" name="racing_start_time" class="form-control" value="{{ old('racing_start_time', $event->racing_start_time?->format('H:i')) }}">
                </div>

                <div class="col-md-4">
                  <label for="admission_general" class="form-label">General Admission ($)</label>
                  <input type="number" step="0.01" id="admission_general" name="admission_general" class="form-control" value="{{ old('admission_general', $event->admission_general) }}">
                </div>

                <div class="col-md-4">
                  <label for="admission_pit" class="form-label">Pit Pass ($)</label>
                  <input type="number" step="0.01" id="admission_pit" name="admission_pit" class="form-control" value="{{ old('admission_pit', $event->admission_pit) }}">
                </div>

                <div class="col-md-4">
                  <label for="admission_kids" class="form-label">Kids Admission ($)</label>
                  <input type="number" step="0.01" id="admission_kids" name="admission_kids" class="form-control" value="{{ old('admission_kids', $event->admission_kids) }}">
                </div>

                <div class="col-12">
                  <label for="status" class="form-label">Status *</label>
                  <select id="status" name="status" class="form-select" required>
                    <option value="scheduled" {{ $event->status === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                    <option value="registration_open" {{ $event->status === 'registration_open' ? 'selected' : '' }}>Registration Open</option>
                    <option value="completed" {{ $event->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $event->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                  </select>
                </div>

                <div class="col-12">
                  <label class="form-label">Vehicle Classes</label>
                  <div class="row">
                    @foreach($vehicleClasses as $class)
                    <div class="col-md-4 mb-2">
                      <div class="form-check">
                        <input type="checkbox" id="class_{{ $class->id }}" name="vehicle_classes[]" value="{{ $class->id }}" class="form-check-input" {{ $event->vehicleClasses->contains($class->id) ? 'checked' : '' }}>
                        <label for="class_{{ $class->id }}" class="form-check-label">{{ $class->name }}</label>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>

                <div class="col-12">
                  <label for="track_condition" class="form-label">Track Condition</label>
                  <input type="text" id="track_condition" name="track_condition" class="form-control" value="{{ old('track_condition', $event->track_condition) }}">
                </div>

                <div class="col-12">
                  <label for="weather_notes" class="form-label">Weather Notes</label>
                  <input type="text" id="weather_notes" name="weather_notes" class="form-control" value="{{ old('weather_notes', $event->weather_notes) }}">
                </div>

                <div class="col-12">
                  <label for="special_notes" class="form-label">Special Notes</label>
                  <textarea id="special_notes" name="special_notes" class="form-control" rows="3">{{ old('special_notes', $event->special_notes) }}</textarea>
                </div>
              </div>

              <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection