<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <meta name="format-detection" content="telephone=no">
        <meta charset="UTF-8">
        <meta name="description" content="Siyaleader Durban University of Technology">
        <meta name="keywords" content="Siyaleader,Durban University of Technology, HIV/AIDS">
        <link rel="icon" type="image/x-icon" sizes="16x16" href="{{ asset('/img/favicon.ico?v1') }}">


        <title>Siyaleader Ports</title>


        <!-- CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('css/generics.css') }}" rel="stylesheet">



    </head>
    <body id="skin-blur-ocean">

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (Session::has('status'))
        <div class="alert alert-info">{{ Session::get('status') }}</div>
    @endif
        <section id="login">
            <header>
                <h1></h1>
                <p></p>
            </header>

            <div class="row">
                <div class="col-lg-3">

                        <form class="box tile animated active" id="box-login" role="form" method="POST" action="{{ url('login') }}">
                            <h2 class="m-t-0 m-b-15">Login</h2>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="text" class="login-control m-b-10" placeholder="Cellphone number" name="cellphone">
                            <input type="password" class="login-control" placeholder="Password" name="password">
                            <div class="checkbox m-b-20">
                                <label>
                                    <input type="checkbox" name="remember">
                                    Remember Me
                                </label>
                            </div>
                            <button class="btn btn-default btn-sm m-r-5" type="submit">Sign In</button>

                            <small>

                                <a class="box-switcher" data-switch="box-reset" href="">Forgot/Change Password?</a>
                            </small>
                        </form>

                    <form class="box animated tile" id="box-reset" method="POST" action="{{ url('/password/email') }}">
                        {!! csrf_field() !!}
                        <h2 class="m-t-0 m-b-15">Reset Password</h2>
                        <p></p>
                        <input type="email" class="login-control m-b-20" name="email" placeholder="Email Address">

                        <button class="btn btn-default btn-sm m-r-5" type="submit">Send Password Reset Link</button>

                        <small><a class="box-switcher" data-switch="box-login" href="">Already have an Account?</a></small>
                    </form>


                </div>

                <div class="col-lg-9" id="login_img" style="height:200px;" >
                    <img  src=""  >
                </div>

            </div>

            <div class="clearfix"></div>

            <!-- Login -->

        </section>

        <!-- Javascript Libraries -->
        <!-- jQuery -->
        <script src="{{ asset('js/jquery.min.js') }}"></script> <!-- jQuery Library -->

        <!-- Bootstrap -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>

        <!--  Form Related -->
        <script src="{{ asset('js/icheck.js') }}"></script> <!-- Custom Checkbox + Radio -->

        <!-- All JS functions -->
        <script src="{{ asset('js/functions.js') }}"></script>
    </body>
</html>
