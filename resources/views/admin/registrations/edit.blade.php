@extends('layouts.admin')

@section('title', 'Edit Registration — Admin')

@section('admin-content')

<div class="mb-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-1">
      <li class="breadcrumb-item"><a href="{{ route('admin.registrations.index') }}">Registrations</a></li>
      <li class="breadcrumb-item active">Edit</li>
    </ol>
  </nav>
  <h1 class="h3 fw-bold">Edit Registration</h1>
</div>

<div class="row g-4">
  <div class="col-lg-8">
    <div class="card border-0 shadow-sm">
      <div class="card-body p-4">
        <form action="{{ route('admin.registrations.update', $registration) }}" method="POST">
          @csrf
          @method('PUT')

          {{-- Event & Class --}}
          <h5 class="fw-bold mb-3">Event & Class</h5>
          <div class="row g-3 mb-4">
            <div class="col-md-6">
              <label for="event_id" class="form-label">Event *</label>
              <select id="event_id" name="event_id" class="form-select" required>
                @foreach($events as $event)
                <option value="{{ $event->id }}" {{ $registration->event_id == $event->id ? 'selected' : '' }}>
                  {{ $event->name }} — {{ $event->event_date?->format('M j, Y') ?? 'TBD' }}
                </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label for="vehicle_class_id" class="form-label">Competition Class *</label>
              <select id="vehicle_class_id" name="vehicle_class_id" class="form-select" required>
                @foreach($classes as $class)
                <option value="{{ $class->id }}" {{ $registration->vehicle_class_id == $class->id ? 'selected' : '' }}>
                  {{ $class->name }}
                </option>
                @endforeach
              </select>
            </div>
          </div>

          {{-- Driver & Team --}}
          <h5 class="fw-bold mb-3">Driver & Team</h5>
          <div class="row g-3 mb-4">
            <div class="col-md-6">
              <label for="driver_id" class="form-label">Driver</label>
              <select id="driver_id" name="driver_id" class="form-select">
                <option value="">— Select Driver —</option>
                @foreach($drivers as $driver)
                <option value="{{ $driver->id }}" {{ $registration->driver_id == $driver->id ? 'selected' : '' }}>
                  {{ $driver->full_name }} @if($driver->team) ({{ $driver->team->name }}) @endif
                </option>
                @endforeach
              </select>
              <div class="form-text">Leave blank if not in driver database.</div>
            </div>
            <div class="col-md-6">
              <label for="team_id" class="form-label">Team</label>
              <select id="team_id" name="team_id" class="form-select">
                <option value="">— Independent —</option>
                @foreach($teams as $team)
                <option value="{{ $team->id }}" {{ $registration->team_id == $team->id ? 'selected' : '' }}>
                  {{ $team->name }}
                </option>
                @endforeach
              </select>
            </div>
          </div>

          {{-- Vehicle Information --}}
          <h5 class="fw-bold mb-3">Vehicle Information</h5>
          <div class="row g-3 mb-4">
            <div class="col-md-3">
              <label for="car_number" class="form-label">Car Number *</label>
              <input type="number" id="car_number" name="car_number" class="form-control" value="{{ $registration->car_number }}" min="1" max="999" required>
            </div>
            <div class="col-md-3">
              <label for="car_make" class="form-label">Make</label>
              <input type="text" id="car_make" name="car_make" class="form-control" value="{{ $registration->car_make }}">
            </div>
            <div class="col-md-3">
              <label for="car_model" class="form-label">Model</label>
              <input type="text" id="car_model" name="car_model" class="form-control" value="{{ $registration->car_model }}">
            </div>
            <div class="col-md-3">
              <label for="car_year" class="form-label">Year</label>
              <input type="number" id="car_year" name="car_year" class="form-control" value="{{ $registration->car_year }}" min="1900" max="{{ date('Y') + 1 }}">
            </div>
            <div class="col-md-6">
              <label for="car_color" class="form-label">Color</label>
              <input type="text" id="car_color" name="car_color" class="form-control" value="{{ $registration->car_color }}">
            </div>
            <div class="col-md-6">
              <label for="transponder_id" class="form-label">Transponder ID</label>
              <input type="text" id="transponder_id" name="transponder_id" class="form-control" value="{{ $registration->transponder_id }}">
            </div>
          </div>

          {{-- Status & Payment --}}
          <h5 class="fw-bold mb-3">Status & Payment</h5>
          <div class="row g-3 mb-4">
            <div class="col-md-4">
              <label for="status" class="form-label">Status *</label>
              <select id="status" name="status" class="form-select" required>
                @foreach(App\Models\Registration::getStatuses() as $value => $label)
                <option value="{{ $value }}" {{ $registration->status === $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4">
              <label for="payment_method" class="form-label">Payment Method</label>
              <select id="payment_method" name="payment_method" class="form-select">
                <option value="">— Not Paid —</option>
                @foreach(App\Models\Registration::getPaymentMethods() as $value => $label)
                <option value="{{ $value }}" {{ $registration->payment_method === $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4">
              <label for="payment_reference" class="form-label">Payment Reference</label>
              <input type="text" id="payment_reference" name="payment_reference" class="form-control" value="{{ $registration->payment_reference }}">
            </div>
            <div class="col-12">
              <div class="form-check">
                <input type="checkbox" id="paid" name="paid" class="form-check-input" value="1" {{ $registration->paid ? 'checked' : '' }}>
                <label for="paid" class="form-check-label">Marked as Paid</label>
              </div>
            </div>
          </div>

          {{-- Notes --}}
          <h5 class="fw-bold mb-3">Notes</h5>
          <div class="row g-3 mb-4">
            <div class="col-12">
              <label for="notes" class="form-label">Internal Notes</label>
              <textarea id="notes" name="notes" class="form-control" rows="3">{{ $registration->notes }}</textarea>
            </div>
            @if($registration->withdrawal_reason)
            <div class="col-12">
              <label class="form-label">Withdrawal Reason</label>
              <p class="text-muted">{{ $registration->withdrawal_reason }}</p>
            </div>
            @endif
          </div>

          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Update Registration</button>
            <a href="{{ route('admin.registrations.index') }}" class="btn btn-outline-secondary">Cancel</a>
            @if($registration->isPending())
            <form action="{{ route('admin.registrations.approve', $registration) }}" method="POST" class="d-inline ms-auto">
              @csrf
              <button type="submit" class="btn btn-success">Approve</button>
            </form>
            @endif
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Sidebar --}}
  <div class="col-lg-4">
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-white">
        <h5 class="fw-bold mb-0">Registration Info</h5>
      </div>
      <div class="card-body">
        <dl class="row mb-0">
          <dt class="col-5">Created</dt>
          <dd class="col-7">{{ $registration->created_at->format('M j, Y H:i') }}</dd>
          <dt class="col-5">Updated</dt>
          <dd class="col-7">{{ $registration->updated_at->format('M j, Y H:i') }}</dd>
          @if($registration->check_in_time)
          <dt class="col-5">Check-in</dt>
          <dd class="col-7">{{ $registration->check_in_time->format('M j, Y H:i') }}</dd>
          @endif
          <dt class="col-5">Status</dt>
          <dd class="col-7"><span class="badge bg-{{ $registration->status_color }}">{{ $registration->status_label }}</span></dd>
        </dl>
      </div>
    </div>

    @if($registration->driver)
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-white">
        <h5 class="fw-bold mb-0">Driver Info</h5>
      </div>
      <div class="card-body">
        <dl class="row mb-0">
          <dt class="col-5">Name</dt>
          <dd class="col-7">{{ $registration->driver->full_name }}</dd>
          @if($registration->driver->hometown)
          <dt class="col-5">Hometown</dt>
          <dd class="col-7">{{ $registration->driver->hometown }}</dd>
          @endif
          @if($registration->driver->license_expires)
          <dt class="col-5">License</dt>
          <dd class="col-7">
            @if($registration->driver->license_valid)
              <span class="badge bg-success">Valid until {{ $registration->driver->license_expires->format('M Y') }}</span>
            @else
              <span class="badge bg-danger">Expired {{ $registration->driver->license_expires->format('M Y') }}</span>
            @endif
          </dd>
          @endif
        </dl>
        <a href="{{ route('admin.drivers.show', $registration->driver) }}" class="btn btn-outline-secondary btn-sm w-100 mt-2">View Driver Profile</a>
      </div>
    </div>
    @endif

    {{-- Quick Actions --}}
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-white">
        <h5 class="fw-bold mb-0">Quick Actions</h5>
      </div>
      <div class="card-body">
        @if($registration->isPending())
        <form action="{{ route('admin.registrations.approve', $registration) }}" method="POST" class="mb-2">
          @csrf
          <button type="submit" class="btn btn-success w-100">Approve Registration</button>
        </form>
        @endif
        @if($registration->isRegistered())
        <form action="{{ route('admin.registrations.check-in', $registration) }}" method="POST" class="mb-2">
          @csrf
          <button type="submit" class="btn btn-info w-100">Mark Checked In</button>
        </form>
        @endif
        @if(!$registration->paid && in_array($registration->status, ['pending', 'registered']))
        <button type="button" class="btn btn-warning w-100 mb-2" data-bs-toggle="modal" data-bs-target="#paymentModal">
          Record Payment
        </button>
        @endif
        @if(in_array($registration->status, ['pending', 'registered']))
        <button type="button" class="btn btn-outline-danger w-100" data-bs-toggle="modal" data-bs-target="#withdrawModal">
          Mark Withdrawn
        </button>
        @endif
      </div>
    </div>
  </div>
</div>

{{-- Payment Modal --}}
<div class="modal fade" id="paymentModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Record Payment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('admin.registrations.mark-paid', $registration) }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method *</label>
            <select id="payment_method" name="payment_method" class="form-select" required>
              @foreach(App\Models\Registration::getPaymentMethods() as $value => $label)
              <option value="{{ $value }}">{{ $label }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="payment_reference" class="form-label">Reference/Transaction ID</label>
            <input type="text" id="payment_reference" name="payment_reference" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-warning">Record Payment</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Withdraw Modal --}}
<div class="modal fade" id="withdrawModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Mark Withdrawn</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('admin.registrations.withdraw', $registration) }}" method="POST">
        @csrf
        <div class="modal-body">
          <p>Are you sure you want to mark this registration as withdrawn?</p>
          <div class="mb-3">
            <label for="withdrawal_reason" class="form-label">Reason (optional)</label>
            <textarea id="withdrawal_reason" name="withdrawal_reason" class="form-control" rows="2"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Mark Withdrawn</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection