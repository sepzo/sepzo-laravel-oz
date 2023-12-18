
@extends('layouts.app')

@section('customCss')
<link rel="stylesheet" href="{{ asset('app.css') }}">
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="text-center card-header">{{ __('User Login') }}</div>
                        <div class="card-body">

                            @if(session('error'))
                                <div class="alert alert-danger m-2">
                                    {{ session('error') }}
                                </div>
                            @endif


                            <form method="POST" action="{{ route('postLogin') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="username" class="form-label">User Email</label>
                                    <input type="text" class="form-control" id="username" name = "email" placeholder="Enter your username">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name = "password" placeholder="Enter your password">
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="remember">
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                                <button type="submit" class="btn btn-primary d-block w-100">Login</button>
                            </form>
                        </div>
                 </div>
            </div>
        </div>
    </div>


@endsection