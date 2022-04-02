<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <title>ISP</title>

        <!--Fontawesome CSS -->
		<link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
        
        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">
        
        <!--Toaster aleart CSS -->
		<link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">

        <!-- DataTables -->
        <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- form Uploads -->
        <link href="{{ asset('assets/plugins/fileuploads/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

        {{-- Date picker  --}}
        <link href="{{ asset('aplugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

        <!-- App css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />


        <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="index.html" class="logo"><span>ISP<span>NET</span></span><i class="mdi mdi-layers"></i></a>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container-fluid">

                        <!-- Page title -->
                        <ul class="nav navbar-nav list-inline navbar-left">
                            <li class="list-inline-item">
                                <button class="button-menu-mobile open-left">
                                    <i class="mdi mdi-menu"></i>
                                </button>
                            </li>
                            <li class="list-inline-item">
                                <h4 class="page-title">Dashboard</h4>
                            </li>
                        </ul>
                        @if (Auth::user()->type != 3)
                            <nav class="navbar-custom">
                                <ul class="list-unstyled topbar-right-menu float-right mb-0">
                                    <li>
                                        <!-- Notification -->
                                        <div class="notification-box">
                                            <ul class="list-inline mb-0">
                                                <li>
                                                    <a href="javascript:void(0);" class="right-bar-toggle">
                                                        <i class="mdi mdi-bell-outline noti-icon"></i>
                                                    </a>
                                                    <div class="noti-dot">
                                                        <span class="dot"></span>
                                                        <span class="pulse"></span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- End Notification bar -->
                                    </li>
                                </ul>
                            </nav>
                        @endif
                    </div><!-- end container -->
                </div><!-- end navbar -->
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <!-- User -->
                    <div class="user-box">
                        <div class="user-img">
                            @if(Auth::user()->profile_img == null)
                                <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail img-responsive">
                            @else
                                <img src="{{ asset('storage/'.Auth::user()->profile_img) }}" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail img-responsive">
                            @endif
                            <div class="user-status offline"><i class="mdi mdi-adjust"></i></div>
                        </div>
                        <h5><a href="#">{{ Auth::user()->name }}</a> </h5>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="{{ route('dashboard.profile') }}" >
                                    <i class="mdi mdi-settings"></i>
                                </a>
                            </li>

                            <li class="list-inline-item">
                                <a href="{{ route('logout') }}" class="text-custom"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi-power"></i>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                    <!-- End User -->

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul>
                        	<li class="text-muted menu-title">Navigation</li>

                            <li>
                                <a href="{{ route('dashboard') }}" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
                            </li>

                            <li>
                                <a href="{{ route('dashboard.profile') }}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span> Profile </span> </a>
                            </li>

                            @if (Auth::user()->type != 3)
                                <li>
                                    <a href="{{ route('dashboard.adminlist') }}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span> Admins List </span> </a>
                                </li>
                                <li>
                                    <a href="{{ route('expense') }}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span> Expense List </span> </a>
                                </li>
                                <li>
                                    <a href="{{ route('package') }}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span> Package List </span> </a>
                                </li>
                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-invert-colors"></i> <span> Customer </span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        <li>
                                            <a href="{{ route('customer.alllist') }}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span>All</span> </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('customer.newlist') }}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span>New Request</span> </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('customer.activelist') }}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span>Active</span> </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('customer.inactivelist') }}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span>Inactive</span> </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ route('withdraw') }}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span> Withdraw </span> </a>
                                </li>
                                <li>
                                <a href="{{ route('invioce') }}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span> Invioce </span> </a>
                                </li>

                            @endif
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>

            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">


                        @yield('content')
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->

                <footer class="footer text-right">
                    {{ now()->year }} © webhifzur
                </footer>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
            @if (Auth::user()->type != 3)
                <div class="side-bar right-bar">
                    <a href="javascript:void(0);" class="right-bar-toggle">
                        <i class="mdi mdi-close-circle-outline"></i>
                    </a>
                    <h4 class="">Notifications</h4>
                    <div class="notification-list nicescroll">
                        <ul class="list-group list-no-border user-list">
                            @foreach (newusernotification() as $user)
                                <li class="list-group-item">
                                    {{-- <a href="{{ route('customer.newlist') }}" class="user-list-item"> --}}
                                    <a href="{{ ($user['messagetype'] == 'newuser') ? route('customer.newlist') : route('customer.inactivelist') }}" class="user-list-item">
                                        <div class="icon bg-info">
                                            <i class="{{ ($user['messagetype'] == 'newuser') ? 'mdi mdi-account' : 'fas fa-file-invoice' }}"></i>
                                        </div>
                                        <div class="user-desc">
                                            <span class="name">{{ $user['username'] }}</span>
                                            <span class="desc">{{ $user['message'] }}</span>
                                            <span class="time">
                                                {{ Carbon\Carbon::parse($user['ago'])->diffForHumans() }}
                                            </span>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>    
            @endif
            
            <!-- /Right-bar -->

        </div>
        <!-- END wrapper -->


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

        <!-- Required datatable js -->
        <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        
        {{-- Date picker js  --}}
        <script src="{{ asset('assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
        
        <script src="{{ asset('assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>

        <script src="{{ asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

        <!-- Buttons examples -->
        <script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
        <!-- Responsive examples -->
        <script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

        
        @yield('section_script')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').DataTable();
                $('#datatable-active').DataTable();
                $('#datatable-inactive').DataTable();

                $('#amounttable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf']
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

        </script>

        <!-- file uploads js -->
        <script src="{{ asset('assets/plugins/fileuploads/js/dropify.min.js') }}"></script>

        <script type="text/javascript">
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop Your Profile Picture',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong appended.'
                },
                error: {
                    'fileSize': 'The file size is too big (1M max).'
                }
            });
        </script>

    </body>
</html>