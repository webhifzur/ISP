<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <title>Adminto - Responsive Admin Dashboard Template</title>

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">

        <!--Toaster aleart CSS -->
		<link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">

        <!-- App css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />

        <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>

    </head>

    <body>
        <!-- Begin page -->
        <div id="wrapper">
            <div class="container">
                <div class="card-box" style="padding: 40px 100px;">
                    <h4 class="header-title m-t-0">Basic Wizard</h4>
                    <form method="POST" action="{{ route('customer.form.post') }}">
                        @csrf
                        <div class="row">
                            @foreach ($packages as $package)
                                <div class="col-lg-3 col-md-3 col-sm-6 selection-wrapper">
                                    <label for="selected-item-{{ $package->id }}" class="card selected-label bg-success">
                                        <input type="radio" name="package_id" id="selected-item-{{ $package->id }}" value="{{ $package->id }}">
                                        <span class="icon"></span>
                                        <div class="selected-content bg-primary text-white">
                                            <h3 class="card-title">{{ $package->package_title }}</h3>
                                            <h5 class="card-title">{{ $package->package_speed }}</h5>
                                            <p class="card-text">{{ $package->package_discription }}</p>
                                            <h1 class="card-title">৳{{ $package->package_price }}</h1>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div id="basicwizard" class=" pull-in">
                            <div class="tab-content b-0 mb-0">
                                <div class="tab-pane m-t-10 active" id="tab1">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row clearfix">
                                                <div class="col-md-6">
                                                    <label class="control-label " for="userName">Name *</label>
                                                    <input class="form-control required" name="name" type="text">
                                                    @error('name')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Email *</label>
                                                    <input class="form-control required" name="email" type="text">
                                                    @error('email')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Phone *</label>
                                                    <input class="form-control required" name="phone" type="text">
                                                    @error('phone')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">NID *</label>
                                                    <input class="form-control required" name="nid" type="text">
                                                    @error('nid')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">PON MAC *</label>
                                                    <input class="form-control required" name="pon_mac" type="text">
                                                    @error('pon_mac')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Route MAC ID *</label>
                                                    <input class="form-control required" name="route_mac" type="text">
                                                    @error('route_mac')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="control-label">Address *</label>
                                                    <textarea class="form-control required" name="address"></textarea>
                                                    @error('address')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mt-3 ml-2">
                                                    <button class="btn btn-primary waves-effect waves-light">SUBMIT</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END wrapper -->
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

        <!-- KNOB JS -->
        <!--[if IE]>
        <script type="text/javascript" src="{{ asset('assets/plugins/jquery-knob/excanvas.js') }}"></script>
        <![endif]-->
        <script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.js') }}"></script>

        <!--Morris Chart-->
		<script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/raphael/raphael-min.js') }}"></script>

        <!--toastr aleart Chart-->
		<script src="{{ asset('assets/js/toastr.min.js') }}"></script>
		<script src="{{ asset('assets/js/toastr.js') }}"></script>

        <!-- Dashboard init -->
        <script src="{{ asset('assets/pages/jquery.dashboard.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/jquery.core.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.app.js') }}"></script>

        @yield('section_script')

    {{-- toastr js --}}
    <script>
        @if(Session::has('succsess'))
            // Display a success toast, with a title
            toastr.success('Your Package Successfully  Registered', 'Congratulation!')
        @endif
       
        @if ($errors->any())
            // Display an error toast, with a title
            toastr.error('You Have Any Error', 'Sorry!')
        @endif
    </script>
    </body>
</html>


