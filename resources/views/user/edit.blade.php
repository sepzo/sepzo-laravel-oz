
@extends('layouts.app') 

@section('customCss')
<link rel="stylesheet" href="{{ asset('app.css') }}">
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="text-center card-header">{{ __('Edit Profile') }}</div>

            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio:</label>
                        <textarea class="form-control" id="bio" name="bio" required>{{ $profile->bio }}</textarea>
                    </div>

                    @if($user->profile && $user->profile->profile_picture)
                    <div class=" mb-3">
                        <label for="current_image" class=" col-form-label text-md-end">Current Profile Image :</label>
                       
                            <img id ="currentImage" width='125' src="{{ asset('storage/profile_pictures/' . $user->profile->profile_picture) }}" alt="Current Profile Image" style="max-width: 200px; height: auto;">
                         
                    </div>
                @else

                <div class="mb-3">
                    <label for="current_image" class="col-form-label text-md-end">Current Profile Image</label>
                   
                        <img id ="currentImage" width="80" src="{{ asset('images/profile.jpg') }}" class="img-fluid" alt="Default Profile Image">
                    
                </div>

                @endif

                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">Profile Picture:</label>
                        <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div> 
    </div>
    </div>

@endsection