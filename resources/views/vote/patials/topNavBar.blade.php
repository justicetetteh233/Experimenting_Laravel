<div style="margin: 2%">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

            <li class="nav-item dropdown" style="margin-right: 30px">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <style>
                        .login-picture {
                            max-width: 50px;
                            max-height: 50px;
                            border-radius: 50%;
                        }
                        </style>
                        <img src="{{ asset('storage/' . Auth::user()->picture_path ) }}" alt="candidate Picture" class="login-picture">
                        <span>{{Auth::user()->name}}</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">View Profile</a></li>
                  <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        </form>

                    </li>
                  <li><a class="dropdown-item" href="#">Remove this account</a></li>
                </ul>
            </li>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Election Management
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="{{ route('candidates.index') }}">Manage Candidates</a></li>
                  <li><a class="dropdown-item" href="{{ route('voters.index') }}">Manage Voters</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{route('members.index')}}">Manage Electoral Commissioners</a></li>
                  <li><a class="dropdown-item" href="{{route('positions.index')}}">Manage Positions</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{route('notifications.index')}}">Notifications</a></li>

                </ul>
              </li>

              <li class="nav-item">
                <a class="nav-link active"  tabindex="-1" aria-current="page" href="{{route('votecasts.index')}}">View Statistics</a>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>

          @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
          @endif

          @if(session('error'))
            <div class="alert alert-danger">
            {{ session('error') }}
            </div>
          @endif

          @if(session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
          @endif

        </div>
      </nav>
    </div>
