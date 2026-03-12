@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    
    {{-- Sidebar --}}
    <div class="col-lg-3 col-xl-2 mb-4">
      @include('admin.partials.sidebar')
    </div>
    
    {{-- Main Content --}}
    <div class="col-lg-9 col-xl-10">
      @yield('admin-content')
    </div>
    
  </div>
</div>
@endsection