@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <div class="clearfix">
                        <div class="pull-left mb-3">
                            <h2>Logo</h2>
                        </div>
                        <div class="pull-right">
                            <h4 class="m-0 d-print-none">Invoice</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="pull-left mt-3">
                                <p><b>{{ $single_invioces->customer->name }}</b></p>
                                <h6>Billing Address</h6>
                                <address class="line-h-24">
                                    {{ $single_invioces->customer->address }}
                                </address>
                                <abbr title="Phone">Phone:</abbr> {{ $single_invioces->customer->phone }}
                            </div>
                        </div><!-- end col -->
                        <div class="col-4 offset-2">
                            <div class="mt-3 pull-right">
                                <p class="m-b-10"><strong>Invioce Date: </strong>{{ $single_invioces->created_at->format('M d Y') }} </p>
                                <p class="m-b-10"><strong>Order Status: </strong> <span class="badge badge-success">Paid</span></p>
                            </div>
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table mt-4">
                                    <thead>
                                        <tr>
                                            <th>Sl No.</th>
                                            <th>Package Name</th>
                                            <th>Package Speed</th>
                                            <th>Package Price</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <b>{{ $single_invioces->package_title }}</b>
                                            </td>
                                            <td>{{ $single_invioces->package_speed }}</td>
                                            <td>{{ $single_invioces->package_price }}</td>
                                            <td class="text-right">{{ $single_invioces->package_price }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="clearfix pt-5">
                                <h6 class="text-muted">Notes:</h6>
                                <small>
                                    All accounts are to be paid within 7 days from receipt of
                                    invoice. To be paid by cheque or credit card or direct payment
                                    online. If account is not paid within 7 days the credits details
                                    supplied as confirmation of work undertaken will be charged the
                                    agreed quoted fee noted above.
                                </small>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="float-right">
                                <h3><b>Total:</b>{{ $single_invioces->package_price }}</h3>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div class="hidden-print mt-4 mb-4">
                        <div class="text-right">
                            <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="fa fa-print m-r-5"></i> Print</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- end row -->
    </div>
@endsection

@section('section_script')

@endsection