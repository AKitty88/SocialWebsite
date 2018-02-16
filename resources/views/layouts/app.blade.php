<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <title> @yield('title') </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link href="https://my-firts-project-kitty88.c9users.io/css/style.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <body>
                  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                      <a class="navbar-brand" style="color:#c0392b;"  href="/">Meet@</a>
                      </button>
                      <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">
                          <li class="nav-item active">
                             @php
                              if (Auth::user()!=null)
                              {
                            @endphp
                                  <a class="nav-link" href="/my_private_friends_public_posts">Posts<span class="sr-only">(current)</span></a>
                            @php
                              } else {
                            @endphp
                                  <a class="nav-link" href="/all_public_posts">Posts<span class="sr-only">(current)</span></a>
                            @php
                              }
                            @endphp
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="/user">People</a>
                          </li>
                          <li class="nav-item">
                           
                          </li>
                          
                          <ul class="nav navbar-nav navbar-right">
                              <!-- Authentication Links -->
                              @if (Auth::guest())
                                  <li><a style="padding: 50px; margin: 30px;" href="{{ route('login') }}">Login</a></li>
                                  <li><a href="{{ route('register') }}">Register</a></li>
                                  
                              @else
                              <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                              @endif
                          </ul>
                        </ul>
                      </div>
                  </nav>
                </body>
            </div>
        </nav>
@yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
