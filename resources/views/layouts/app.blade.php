<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                        @php
                        $url = Request::segments();
                        @endphp

                        @if($url != [])
                        @if (Route::has('login'))

                        @if($url[0] =="security")
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('security/login') }}">{{ __('Login') }}</a>
                        </li>
                        @elseif($url[0] =="admin")
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('admin/login') }}">{{ __('Login') }}</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif
                        @endif
                        @endif


                        @if($url != [])
                        @if (Route::has('register'))
                        @if($url[0] !="admin")
                        @if($url[0] =="security")
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('security/register') }}">{{ __('Register') }}</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>

                        @endif
                        @endif
                        @endif
                        @endif

                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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


    <!-- for dynamic years -->
    <script>
    let dateDropdown = document.getElementById('year-dropdown');
    let currentYear = new Date().getFullYear();

    let maxYear = (currentYear + 31);
    let y;

    for (y = currentYear; y < maxYear; y++) {
        let dateOption = document.createElement('option');
        dateOption.text = currentYear;
        dateOption.value = currentYear;
        dateDropdown.add(dateOption);
        currentYear += 1;
    }
    </script>

    
    <!-- for dynamic months -->
    <script>
    (() => {
        let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September",
            "October", "November", "December"
        ];
        let month_selected = (new Date).getMonth(); // current month
        let option = '';
        let month_value = '';
        option = '<option value="Month">Month</option>'; // first option

        for (let i = 0; i < months.length; i++) {
            let month_number = (i + 1);

            // 1, set option value month number adding 0. [01 02 03 04..]
            month_value = (month_number <= 9) ? '0' + month_number : month_number;

            // 2 , or set option value month number. [1 2 3 4..]
            // month_value = month_number;

            // 3, or set option value month names. [January February]
            // month_value = months[i];

            let selected = (i === month_selected ? ' selected' : '');
            option += '<option value="' + month_value + '"' + selected + '> ' + months[i] +
                '</option>';
        }
        document.getElementById("month-dropdown").innerHTML = option;
    })();
    </script>
</body>

</html>