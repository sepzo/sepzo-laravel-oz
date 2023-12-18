@extends('layouts.app')
 
@section('customCss')
<link rel="stylesheet" href="{{ asset('app.css') }}">
@endsection

@section('content')
    <div class="row justify-content-center">
        
        <div class="col-lg-6 bg-light p-0 border m-2 ">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger m-2">
                        {{ session('error') }}
                    </div>
                

                @else
                <h2 class="card-header bg-dark text-white text-center p-2">User</h2>
                <div class="p-4">
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>ID:</strong> {{ $user->id }}</p>
                </div> 
                <!-- Display Profile Information -->
                <h2 class="card-header bg-dark text-white text-center p-2">Profile Details</h2>
                <div class="p-4">
                    <p><strong>Email:</strong> {{ $user->email ?? 'N/A' }}</p>
                    <p><strong>Bio:</strong> {{ $profile->bio ?? 'N/A' }}</p>
                    <p><strong>Display Pic:</strong> 
                       @php
                           $userId = session('userId'); 
                           $profile = $user->profile; 
                       @endphp 
                    @if ($user->profile && $user->profile->profile_picture)
                                <img width="250" src="{{ asset('storage/profile_pictures/' . $user->profile->profile_picture) }}" class="img-fluid" alt="Profile Image">
                    @else 
                        <img  width="250" src="{{ asset('images/profile.jpg') }}" class="img-fluid" alt="Default Profile Image">
                    @endif
                </div>  
        </div>
    </div>
    @endif
    <div class="profile-action m-2">
        <a href="{{ route('user.index') }}" class="btn btn-info"><- Users</a>
        <a href="{{ route('home') }}" class="btn btn-primary">Back to Home -></a>
    </div>
@endsection
 
