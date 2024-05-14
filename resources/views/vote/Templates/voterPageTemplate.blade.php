<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite(['resources/css/votersPageTemplate.css'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <div id="wrapper">
        <div class="overlay"></div>
        <nav class="navbar navbar-inverse fixed-top" id="sidebar-wrapper" role="navigation">
          <ul class="nav sidebar-nav">
            <div class="sidebar-header">
                <div class="sidebar-brand">
                <style>
                    .voters-picture {
                        max-width: 120px; /* Set the maximum width of the picture */
                        max-height: 120px; /* Set the maximum height of the picture */
                        border-radius: 50%; /* Optional: Make the picture round */
                    }
                </style>
                <img src="{{ asset('storage/' . $voter->picture_path) }}" alt="candidate Picture" class="voters-picture">
                
                <div style="font-style: italic; color:white; margin-bottom:10px;">
                    <strong>Welcome {{$voter->email}}</strong>
                </div>

                <div>
                    <p style="color:green">Votes  Casts: <span style="color:green" >{{$totalVotesCasts}}</span> </p>
                    <p>Pending Votes: <span>{{$pendingVotes}}</span> </p>
                </div>

                </div>
            </div>

            <li><a href="?action=castVote" data-file="" >Cast Votes</a></li>
            <li><a href="?action=votesDetails">Votes Details</a></li>
            <li><a href="#events">Report Problems</a></li>
            <li><a href="#team">Vote Analysis</a></li>

            <li class="dropdown">
            <a href="#works" class="dropdown-toggle"  data-toggle="dropdown">Other services <span class="caret"></span></a>
            <ul class="dropdown-menu animated fadeInLeft" role="menu">
            <div class="dropdown-header">Activities</div>
            <li><a href="#pictures">Pictures Reports</a></li>
            <li><a href="#videos">Videos Reports</a></li>
            <li><a href="#books">Voting News</a></li>
            <li><a href="#art">Statistics</a></li>
            <li><a href="#awards">Anouncements</a></li>
            <li><a href="#awards">Registers</a></li>
            <li><a href="#awards">Electoral Commissioners</a></li>
            <li><a href="#awards">Candidates</a></li>
            <li><a href="#awards">Positions</a></li>
            </ul>
            </li>


           <li><a href="#services">Voters Profile</a></li>
           <li><a href="#contact">Contact Us</a></li>

           <li>
                <a class="nav-link" href="{{ route('voterLogout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
           </li>

           </ul>
       </nav>

             <div id="page-content-wrapper">
                 <button type="button" class="hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
                     <span class="hamb-top"></span>
                     <span class="hamb-middle"></span>
                     <span class="hamb-bottom"></span>
                 </button>

                 <div class="container">
                     <div class="row">
                         <div class="col-lg-8 col-lg-offset-2">

                            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                <div class="container">
                                    <a class="navbar-brand" href="#"><h2>
                                        Hello {{$voter->name}}
                                    </h2></a>
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <ul class="navbar-nav ml-auto">
                                            <li class="nav-item">
                                                <!-- Logout link -->
                                                <a class="nav-link" href="{{ route('voterLogout') }}"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- Logout form -->
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </nav>
                            
                            <div id="contentContainer">
                                @if(isset($_GET['action']) && $_GET['action'] === 'castVote')
                                    @include('vote.castVotePage')
                                @elseif (isset($_GET['action']) && $_GET['action'] === 'votesDetails')
                                    @include('vote.votersDetails')
                                @else
                                    <h2>Welcome to the Voting System</h2>
                                    <p>Select an action from the sidebar to get started.</p>
                                @endif
                            </div>
                            
                         </div>
                     </div>
                 </div>
             </div>
             <!-- /#page-content-wrapper -->
     
         </div>
         <!-- /#wrapper -->
   
</body>
</html>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        var trigger = $('.hamburger'),
            overlay = $('.overlay'),
            isClosed = false;

        trigger.click(function () {
            hamburger_cross();
        });

        function hamburger_cross() {
            if (isClosed == true) {
                $('#wrapper').removeClass('toggled');
                overlay.hide();
                trigger.removeClass('is-open');
                trigger.addClass('is-closed');
                isClosed = false;
            } else {
                $('#wrapper').addClass('toggled');
                overlay.show();
                trigger.removeClass('is-closed');
                trigger.addClass('is-open');
                isClosed = true;
            }
        }

        $('[data-toggle="offcanvas"]').click(function () {
            $('#wrapper').toggleClass('toggled');
        });
    });
</script>