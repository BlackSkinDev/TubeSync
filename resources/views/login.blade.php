<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Login | TubeSync</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="../favicon.ico" type="image/x-icon" />

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
        
        <link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="plugins/ionicons/dist/css/ionicons.min.css">
        <link rel="stylesheet" href="plugins/icon-kit/dist/css/iconkit.min.css">
        <link rel="stylesheet" href="plugins/perfect-scrollbar/css/perfect-scrollbar.css">
        <link rel="stylesheet" href="dist/css/theme.min.css">
        <script src="src/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="auth-wrapper">
            <div class="container-fluid h-100">
                <div class="row flex-row h-100 bg-white">
                    <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                        <div class="lavalite-bg" style="background-image: url('assets/img/warehouse.jpg')">
                            <div class="lavalite-overlay"></div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
                        <div class="authentication-form mx-auto">
                            <div class="logo-centered">
                                <a href="/"><h1>TubeSync</h1></a>
                            </div>
                            @if(Session::has('message'))
                                  <div class="alert alert-danger" role="alert">
                                    {{Session::get('message')}}
                                  </div>
                                @endif
                           
                            <h3>Login to TubeSync</h3>
                            <form action="/signin" method="post">
                                 {{csrf_field() }}
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Email your email" name="email">
                                    <i class="ik ik-mail"></i>
                                     @if($errors->has('email'))
                                      <div class="text-danger mt-2">
                                        {{ $errors->first('email') }}
                                      </div><br>
                                     @endif
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Enter your Password" name="password">
                                    <i class="ik ik-lock"></i>
                                     @if($errors->has('password'))
                                      <div class="text-danger mt-2">
                                        {{ $errors->first('password') }}
                                      </div><br>
                                     @endif
                                </div>
                                
                                    <div class="col text-right">
                                       <!--  <a href="forgot-password.html">Forgot Password ?</a> -->
                                    </div>
                                
                                <div class="sign-btn text-center mb-4">
                                    <button class="btn btn-theme">Sign In</button>
                                </div>
                              
                                 <div class="register">
                                <p>
                                    <a href="/" class="btn btn-primary">Create New Account</a>
                                    <a href="/" class="btn btn-warning">Sign In with google</a>
                                </p>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script>window.jQuery || document.write('<script src="../src/js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
        <script src="../plugins/popper.js/dist/umd/popper.min.js"></script>
        <script src="../plugins/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
        <script src="../plugins/screenfull/dist/screenfull.js"></script>
        <script src="../dist/js/theme.js"></script>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>
