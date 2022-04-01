<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <title>Adminto - Responsive Admin Dashboard Template</title>

        <!-- App css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />

        <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>

    </head>


    <body class="fixed-left">

        <div class="row mt-5 d-flex justify-content-center">
            <div class="col-xl-6">
                <div class="card-box">

                    <h4 class="header-title m-t-0 m-b-30">Login Here</h4>

                    <form method="POST" action="{{ route('login') }}" class="form-horizontal" role="form" data-parsley-validate novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="emailAddress">Email or User ID*</label>
                            <input type="text" name="email" parsley-trigger="change" 
                                   placeholder="Enter email" class="form-control" id="emailAddress">
                        </div>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="pass1">Password*</label>
                            <input id="pass1" name="password" type="password" placeholder="Password" 
                                class="form-control" autocomplete="new-password">
                        </div>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <div class="form-group">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="offset-sm-12 col-md-12 d-flex justify-content-between">
                        <a href="{{ route('password.request') }}" class="">forget Password?</a>
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                    </div>
                </div>
            </div><!-- end col -->
        </div>
        <!-- end row -->


        <!-- jQuery  -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/detect.js') }}"></script>
        <script src="{{ asset('assets/js/fastclick.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('assets/js/waves.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.scrollTo.min.js') }}"></script>

        <!-- Validation js (Parsleyjs) -->
        <script type="text/javascript" src="{{ asset('assets/plugins/parsleyjs/dist/parsley.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/jquery.core.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.app.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('form').parsley();
            });
        </script>


    </body>
</html>