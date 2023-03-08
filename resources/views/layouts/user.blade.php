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
    {{--    <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
          {{-- <a class="navbar-item" href="https://bulma.io">
            <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
          </a> --}}

            <a class="navbar-item" href="/">
                <h1 class="ml-5" style="font-weight: bolder; font-size: 2em;">LeaMS</h1>
            </a>
      
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
      
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">

            </div>
      
          <div class="navbar-end">
            <a class="navbar-item" href="/home">
                Home
            </a>
            <a class="navbar-item" href="/personal-data-sheet">
                Personal Data Sheet
            </a>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    {{ strtoupper(\Auth::user()->fname) }}
                </a>
                <div class="navbar-dropdown">
                    <a class="navbar-item" href="/change-password">
                        Change Password
                    </a>
                    {{-- <a class="navbar-item">
                        Jobs
                    </a>
                    <a class="navbar-item">
                        Contact
                    </a>
                    <hr class="navbar-divider">
                    <a class="navbar-item">
                        Report an issue
                    </a> --}}
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <div class="navbar-dropdown">
                    <a class="navbar-item" href="/change-password">
                        Change Password
                    </a>
                </div>
            </div>
            
            <div class="navbar-item">
              <div class="buttons">
                <a class="button is-outlined is-danger" onclick="logout()">
                    Log out
                    <i class="mdi mdi-logout"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </nav>

      <form id="form-logout" action="/logout" method="post">
        @csrf
      </form>


    <div id="app">
        <div>
            @yield('content')
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // Get all "navbar-burger" elements
            const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

            // Add a click event on each of them
            $navbarBurgers.forEach( el => {
                el.addEventListener('click', () => {

                    // Get the target from the "data-target" attribute
                    const target = el.dataset.target;
                    const $target = document.getElementById(target);

                    // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                    el.classList.toggle('is-active');
                    $target.classList.toggle('is-active');

                });
            });

        });

        function logout(){
            document.getElementById('form-logout').submit();
        }

    </script>
</body>

</html>
