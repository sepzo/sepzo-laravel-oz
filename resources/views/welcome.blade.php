@extends('layouts.app')
 
@section('customCss')
<link rel="stylesheet" href="{{ asset('app.css') }}">
@endsection

@section('content')

    @if (isset($profileContent))
        {!! $profileContent !!}
    @else
      <div class="row">
        <div class="col-md-6 mx-auto">
          <h5 class="text-center">Welcome to {{ config('app.name') }}</h5>
          <div class="card text-center">
              <div class="card-header bg-dark text-white">
                  <h2>Total Number of Users</h2>
              </div>
              <div class="card-body">
                  <h1 class=" s">{{ $totalUsers }} </h1>
                  <a href="{{ route('user.index') }}" 
                  class="btn btn-primary" title="View All Users">View All</a>
              </div>
          </div>
        </div>
      </div>
    @endif

@endsection