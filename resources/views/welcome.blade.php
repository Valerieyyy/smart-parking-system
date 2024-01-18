<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> SMART PARKING SYSTEM</title>
  
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/layout.css') }}">
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/"> <img src="{{ asset('assets/img/Polytechnic_University_of_the_Philippines_Biñan_Logo.svg.png') }}" width="40px" height="auto" >  Smart Parking System</style></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/home">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/">About</a>
                        </li>

                        <!-- <li class="nav-item">
                            <a class="nav-link" href="/manual_log">C</a>
                        </li> -->
                        
                    </ul>
                        <!-- <form class="form-inline  my-lg-0">
                                <a href ="/login"><button type="button" class="btn btn-outline-light">Login</button></a>
                                
                        </form> -->

                        <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <!-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif -->
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
    </nav>
    <header class="masthead">
            <div class="container">
                <div class="logo">
                    <img src="{{ asset('assets/img/Polytechnic_University_of_the_Philippines_Biñan_Logo.svg.png') }}" width="228" height="auto">
                    </div>
                        <div class="waviy">
                        <span style="--i:1">W</span>
                        <span style="--i:1">E</span>
                        <span style="--i:1">L</span>
                        <span style="--i:1">C</span>
                        <span style="--i:1">O</span>
                        <span style="--i:1">M</span>
                        <span style="--i:1">E</span>
                        <br>
                        <span style="--i:1">T</span>
                        <span style="--i:1">O</span>
                        
                            
                        </div>
                
                <div class="masthead-heading text-uppercase"><b style="color:white">SMART PARKING SYSTEM</b> <b style="color:maroon">Polytechnic University of the Philippines - Binan Campus
</b></div>
                <a class="btn btn-danger  btn-xl text-uppercase" href="https://www.pup.edu.ph/binan/">Tell Me More</a>
            </div>
        </header>

         <!-- Services-->
         <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">UNIVERSITY VISION, MISSION, & The PUP Philosophy (Pilosopiya ng PUP)</h2>
                  
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">VISION</h4>
                        <p class="text-muted">PUP: The National Polytechnic University</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">MISSION</h4>
                        <p class="text-muted">Ensuring inclusive and equitable quality education and promoting lifelong learning opportunities through a re-engineered polytechnic university by committing to:<br>
                                
                                1.provide democratized access to educational opportunities for the holistic development of individuals with global perspective
                                2.offer industry-oriented curricula that produce highly-skilled professionals with managerial and technical capabilities and a strong sense of public service for nation building
                                3.embed a culture of research and innovation
                                4.continuously develop faculty and employees with the highest level of professionalism
                                5.engage public and private institutions and other stakeholders for the attainment of social development goal
                                6.establish a strong presence and impact in the international academic community

                        </p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">The PUP Philosophy (Pilosopiya ng PUP)</h4>
                        <p class="text-muted">As a state university, the Polytechnic University of the Philippines believes that:<br>
                        
                            Education is an instrument for the development of the citizenry and for the enhancement of nation building; and<br>
                            That meaningful growth and transformation of the country are best achieved in an atmosphere of brotherhood, peace, freedom, justice and nationalist-oriented education imbued with the spirit of humanist internationalism.

                        </p>
                    </div>
                </div>
            </div>
        </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>