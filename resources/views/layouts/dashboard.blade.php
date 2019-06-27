<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    <link href="{{ asset('vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/argon.css?v=1.0.0') }}"> 
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/argon.js?v=1.0.0') }}"></script>  

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <style>
    
        body{
            font-family: Segoe UI;
            background-color: #eeeeee;
            margin:0;
            overflow-x: hidden;
            color: #262626;
        }
        .data{
            margin-top:9rem
        }
        .category{
            padding: 8px 0px 8px 0px;
            transition: 0.5s;
        }   
        .category:hover{
            padding-left: 8px;
            background-color: #fcfdff
        }
        a{
            color: black;
            transition: color 0.2s;
        }
        a:hover{
            color:grey
        }
        .login{
            background-color: #efefef
        }
        .logo{
            color:black;
        }
        nav{
            box-shadow: 0 2px 10px 0 #ccc
            z-index:-1;
        }
        .homepage-content-center{
            background-color: #fcfcfc;
            width: 100%;
            height: 12rem;
        }
        .homepage-content-bottom{
            background-color: #dddddd;
            width: 100%;
            height: 26rem;
        }
        .content{
            font-family: Segoe UI;
            width: 100%;
            height: 30rem;
            border-radius: 0px;
            background-color: #eeeeee
        }
        .content-img{
            margin: 120px 10px 30px 150px;
            width: 35rem;
            position: absolute;
        }
        .content-img2{
            margin: 240px 10px 30px 800px;
            width: 30rem;
            position: absolute;
        }
        .slogan{
            position:absolute;
            font-size: 2.5em;
            margin: 140px 10px 30px 50rem;
        }
        .slogan2{
            position:absolute;
            font-size: 2.5em;
            margin: 140px 10px 30px 10rem;
        }
        .footer {
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #262626;
            color: white;
            text-align: center;
          }
          .acces {
            box-shadow: 0 2px 10px 0 #ccc;              
            transform: rotate(50deg);
            position: fixed;
            height: 7rem;
            left: 0;
            top: 0;
            width: 100px;
            background-color: white;
          }
          .card{
              border-radius: 0px;
              border: none;
          }
          
          .alert-neutral{
            background-color: #262626;
            color: white;
            border: none;
          }
    </style>
</head>
<body>
<nav class="navbar navbar-top navbar-expand-md navbar-white bg-dark" id="navbar-main">
            <div class="container-fluid">
            
                <!-- Brand -->
                <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{url('/')}}"><img src="{{asset('img/logo.png')}}" style="width:3%">ODIN</a>
                
                <!-- User -->
                <ul class="navbar-nav align-items-center d-none d-md-flex">
                @guest
                <a href="" class="btn btn-neutral" data-toggle="modal" data-target="#login">Login</a>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media align-items-center">
                                <div class="media-body ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold" style="color:white">{{ Auth::user()->name }}</span>
                                </div>
                            </div>
                        </a>
                    
                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        <a href="{{url('/profile')}}" class="dropdown-item" >Profil</a>
                        <a class="dropdown-item" href="{{url('/riwayat')}}">Riwayat Peminjaman</a>
                        <a class="dropdown-item" href="{{url('/help')}}">Petunjuk</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}
                         </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>

@yield('home') 
<div style="margin-top:2rem">
@yield('content')  
</div>




<!-- Modal -->
<div class="modal fade " id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
            <center><span class="modal-title" id="modaltitle" style="color: red"></span></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                
            </div>
            <div class="modal-body login">
                <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }} | hafizhrf@gmail.com</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }} | kuroneko</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-neutral">
                            {{ __('Login') }}
                        </button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
</body>

</html>























