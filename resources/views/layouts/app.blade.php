<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('customCss')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" 
                            href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('users') ? 'active' : '' }}"
                             href="{{ route('user.index') }}">All Users</a>
                    </li>

                    @auth 

                        <li class="nav-item">
                            <a class="nav-link  {{ request()->is('edit') ? 'active' : '' }}"
                                href="{{ route('user.edit') }}">Edit Profile</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('logout') }}">Log Out</a>
                        </li>
                    @else

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('register') ? 'active' : '' }}"
                                href="{{ route('register') }}">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('login') ? 'active' : '' }}"
                                href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth

                   
                </ul>
            </div>
        </div>
    </nav>


    <div class="container mt-5"> 

        @yield('content')  
        @yield('script')  

    </div>

   
   
    
</body>
</html>