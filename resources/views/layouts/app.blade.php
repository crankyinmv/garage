<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex" href="{{ url('/') }}">
                    <div><img src='/car.png' style='height:25px' alt='junkers welcome' /></div>
		<div class='ps-3'>{{ config('app.name', 'Laravel') }}</div>
                </a>
                <!-- Garage stuff -->
@if(Auth::User())                
                    <a class="d-flex ps-1 pe-1" href='/cars' style='text-decoration:none'><button class="btn btn-outline-info btn-small">Show Cars</button>
                    <a class="d-flex ps-1 pe-1" href='/trucks' style='text-decoration:none'><button class="btn btn-outline-info btn-small">Show Trucks</button>
                    <a class="d-flex ps-1 pe-2" href='/boats' style='text-decoration:none'><button class="btn btn-outline-info btn-small">Show Boats</button>
@if(!Auth::User()->admin)
                    <a class="d-flex ps-1 pe-1" href='/cars/create' style='text-decoration:none'><button class="btn btn-outline-info btn-small">Add a Car</button>
                    <a class="d-flex ps-1 pe-1" href='/trucks/create' style='text-decoration:none'><button class="btn btn-outline-info btn-small">Add a Truck</button>
                    <a class="d-flex ps-1 pe-1" href='/boats/create' style='text-decoration:none'><button class="btn btn-outline-info btn-small">Add a Boat</button>
@endif                    
@else
@php
/* For testing anonymous access. */
$car = \App\Models\Cars::first();
$boat = \App\Models\Boats::first();
$truck = \App\Models\Trucks::first();
$carId = $car ? $car->id : -1;
$truckId = $truck ? $truck->id : -1;
$boatId = $boat ? $boat->id : -1;
@endphp
<form action='/cars/create' method='post'>@csrf <button type="submit" class="btn btn-outline-info btn-small max-w-3xl">Test Add Car</button></form>
<form action='/trucks/create' method='post'>@csrf <button type="submit" class="btn btn-outline-info btn-small max-w-3xl">Test Add Truck</button></form>
<form action='/boats/create' method='post'>@csrf <button type="submit" class="btn btn-outline-info btn-small max-w-3xl">Test Add Boat</button></form>
@if($carId != -1)
<form action='/cars/{{$carId}}' method='post'>@csrf <button type="submit" class="btn btn-outline-info btn-small max-w-3xl">Test Update Car {{$carId}}</button></form>
<form action='/cars/delete/{{$carId}}' method='post'>@csrf <button type="submit" class="btn btn-outline-info btn-small max-w-3xl">Test Remove Car {{$carId}}</button></form>
@endif
@if($truckId != -1)
<form action='/trucks/{{$truckId}}' method='post'>@csrf <button type="submit" class="btn btn-outline-info btn-small max-w-3xl">Test Update Truck {{$truckId}}</button></form>
<form action='/trucks/delete/{{$truckId}}' method='post'>@csrf <button type="submit" class="btn btn-outline-info btn-small max-w-3xl">Test Remove Truck {{$truckId}}</button></form>
@endif
@if($boatId != -1)
<form action='/boats/{{$boatId}}' method='post'>@csrf <button type="submit" class="btn btn-outline-info btn-small max-w-3xl">Test Update Boat {{$boatId}}</button></form>
<form action='/boats/delete/{{$boatId}}' method='post'>@csrf <button type="submit" class="btn btn-outline-info btn-small max-w-3xl">Test Remove Boat {{$boatId}}</button></form>
@endif                    
@endif                    
                <div>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @yield('footer-scripts')
</body>
</html>
