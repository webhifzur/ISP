@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if (Auth::user()->type != 3)    
        <div class="row bg-muted p-3 mb-3">
            <div class="col-xl-12">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <div class="input-daterange input-group" id="date-range">
                            <input type="text" class="form-control" name="start_date" placeholder="Starting Date" id="start_date" value=""/>
                            <span class="input-group-addon bg-primary b-0 text-white">to</span>
                            <input type="text" class="form-control" name="end_date" placeholder="Ending Date" id="end_date" value=""/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" id="form_btn" class="bg-primary text-white p-2" style="border:none; cursor:pointer; ">Submit</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card-box">
                    <h4 class="header-title mt-0 m-b-30">Total Customer</h4>
                    <div class="widget-chart-1">
                        <div class="widget-chart-box-1">
                            <i class="fas fa-user-tie" style="font-size: 50px"></i>
                        </div>
                        <div class="widget-detail-1 text-center">
                            <h2 class="mb-0" id="customers"> {{ $customers }} </h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-xl-3 col-md-6">
                <div class="card-box">
                    <h4 class="header-title mt-0 m-b-30">Total Package</h4>
                    <div class="widget-chart-1">
                        <div class="widget-chart-box-1">
                            <i class="fas fa-box" style="font-size: 50px"></i>
                        </div>
                        <div class="widget-detail-1 text-center">
                            <h2 class="mb-0" id="packages"> {{ $packages }} </h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-xl-3 col-md-6">
                <div class="card-box">
                    <h4 class="header-title mt-0 m-b-30">Total Active Customer</h4>
                    <div class="widget-chart-1">
                        <div class="widget-chart-box-1">
                            <i class="fas fa-user-tie" style="font-size: 50px"></i>
                        </div>
                        <div class="widget-detail-1 text-center">
                            <h2 class="mb-0" id="active_customers"> {{ $active_customers }} </h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-xl-3 col-md-6">
                <div class="card-box">
                    <h4 class="header-title mt-0 m-b-30">Total Inactive Customer</h4>
                    <div class="widget-chart-1">
                        <div class="widget-chart-box-1">
                            <i class="fas fa-user-tie" style="font-size: 50px"></i>
                        </div>
                        <div class="widget-detail-1 text-center">
                            <h2 class="mb-0" id="inactive_customers"> {{ $inactive_customers }} </h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-xl-3 col-md-6">
                <div class="card-box">
                    <h4 class="header-title mt-0 m-b-30">Total Earn Amount</h4>
                    <div class="widget-chart-1">
                        <div class="widget-chart-box-1">
                            <span style="font-size: 50px"> ৳ </span>
                        </div>
                        <div class="widget-detail-1 text-center">
                            <h2 class="mb-0" id="total_incomes"> {{ $total_incomes }} </h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-xl-3 col-md-6">
                <div class="card-box">
                    <h4 class="header-title mt-0 m-b-30">Total Cost</h4>
                    <div class="widget-chart-1">
                        <div class="widget-chart-box-1">
                            <span style="font-size: 50px"> ৳ </span>
                        </div>
                        <div class="widget-detail-1 text-center">
                            <h2 class="mb-0" id="total_cost"> {{ $total_cost }} </h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-xl-3 col-md-6">
                <div class="card-box">
                    <h4 class="header-title mt-0 m-b-30">Total Profit</h4>
                    <div class="widget-chart-1">
                        <div class="widget-chart-box-1">
                            <span style="font-size: 50px"> ৳ </span>
                        </div>
                        <div class="widget-detail-1 text-center">
                            <h2 class="mb-0" id="profit"> {{ $total_incomes - $total_cost }} </h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-xl-3 col-md-6">
                <div class="card-box">
                    <h4 class="header-title mt-0 m-b-30">Total Invoice</h4>
                    <div class="widget-chart-1">
                        <div class="widget-chart-box-1">
                            <i class="fas fa-file-invoice" style="font-size: 50px"></i>
                        </div>
                        <div class="widget-detail-1 text-center">
                            <h2 class="mb-0" id="invoices"> {{ $invoices }} </h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="header-title mt-0 m-b-30">Active Customer</h4>

                    <table id="datatable-active" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="align-middle text-center">Sl.</th>
                            <th class="align-middle text-center">Name</th>
                            <th class="align-middle text-center">Email</th>
                            <th class="align-middle text-center">Phone</th>
                            <th class="align-middle text-center">Net ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activecustomers as $customer)
                            <tr>
                                <td class="align-middle text-center">{{ ++$loop->index }}</td>
                                <td class="align-middle text-center">{{ $customer->name }}</td>
                                <td class="align-middle text-center">{{ $customer->email }}</td>
                                <td class="align-middle text-center">{{ $customer->phone }}</td>
                                <td class="align-middle text-center">{{ get_customer_netid($customer->user_id)->net_id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div><!-- end col -->

            <div class="col-12">
                <div class="card-box">
                    <div class="mt-0 m-b-30 d-flex justify-content-between">
                        <h4 class="header-title">Inactive Customer</h4>
                        <a href="{{ route('sendmessage') }}" class="btn btn-primary">Send Reactive Message To All</a>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable-inactive" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="align-middle text-center">Sl.</th>
                            <th class="align-middle text-center">Name</th>
                            <th class="align-middle text-center">Email</th>
                            <th class="align-middle text-center">Phone</th>
                            <th class="align-middle text-center">Net ID</th>
                            <th class="align-middle text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inactivecustomers as $customer)
                            <tr>
                                <td class="align-middle text-center">{{ ++$loop->index }}</td>
                                <td class="align-middle text-center">{{ $customer->name }}</td>
                                <td class="align-middle text-center">{{ $customer->email }}</td>
                                <td class="align-middle text-center">{{ $customer->phone }}</td>
                                <td class="align-middle text-center">{{ get_customer_netid($customer->user_id)->net_id }}</td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('sendmessage.single',$customer->id) }}" class="btn btn-primary">Send Reactive Message</a>
                                </td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                </table>
                    </div>
                </div>
            </div><!-- end col -->
        </div>
        <!-- end row -->
    @endif
    
    @if (Auth::user()->type == 3)
        {{-- Start Customer Dashboard  --}}
        <div class="row bg-muted p-3 mb-3">
            <div class="col-xl-12">
                {{ usernotification() }}
            </div>
                {{-- Data tables For Admin Start --}}
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <h1 class="m-t-0 header-title" style="font-size:40px; text-align:center; margin-bottom:50px !important;"><b>List Of Invioce</b></h1>
                        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="align-middle text-center">Sl No.</th>
                                    <th class="align-middle text-center">Invioce Id</th>
                                    <th class="align-middle text-center">Invioce Date</th>
                                    <th class="align-middle text-center">Package Name</th>
                                    <th class="align-middle text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($total_invioce as $invioce)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $invioce->invoice_no }}</td>
                                        <td>{{ $invioce->created_at }}</td>
                                        <td>{{ $invioce->package_title }}</td>
                                        <td>
                                            <a href="{{ route('singleinvioce',$invioce->id) }}" class="btn btn-success btn-sm rounded-0" target="_blank">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- Data tables For Admin Start --}}
        </div>
        <!-- end row -->
    @endif


</div> <!-- container -->
@endsection


@section('section_script')
     <script>
            // Date Picker
            jQuery('#datepicker').datepicker();
            jQuery('#datepicker-autoclose').datepicker({
                autoclose: true,
                todayHighlight: true
            });
            jQuery('#datepicker-inline').datepicker();
            jQuery('#datepicker-multiple-date').datepicker({
                format: "yyyy-mm-dd",
                clearBtn: true,
                multidate: true,
                multidateSeparator: ","
            });
            jQuery('#date-range').datepicker({
                format: "yyyy-mm-dd",
                toggleActive: true
            });

            //Ajax script
            $(document).ready(function(){
                 $('#form_btn').on('click',function(){
                    var start_date = $('#start_date').val();
                    var end_date = $('#end_date').val();
                    //ajax setup
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type :'POST',
                        url : '/get/filter/date',
                        data : {start_date:start_date , end_date:end_date},
                        success : function (data) {
                            document.getElementById('customers').innerHTML = data['customers'];
                            document.getElementById('packages').innerHTML = data['packages'];
                            document.getElementById('active_customers').innerHTML = data['active_customers'];
                            document.getElementById('inactive_customers').innerHTML = data['inactive_customers'];
                            document.getElementById('invoices').innerHTML = data['invoices'];
                            document.getElementById('total_incomes').innerHTML = data['total_incomes'];
                            document.getElementById('total_cost').innerHTML = data['total_cost'];
                            document.getElementById('profit').innerHTML = data['total_incomes'] - data['total_cost'];
                        }
                    });
                });
            });
        </script>
        {{-- toastr js --}}
        <script>
            @if(Session::has('succsess'))
                // Display a success toast, with a title
                toastr.success('Your Successfully  Registered', 'Congratulation!')
            @endif
        
            @if ($errors->any())
                // Display an error toast, with a title
                toastr.error('You Have Any Error', 'Sorry!')
            @endif
        </script>
@endsection