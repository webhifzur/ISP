@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
                <div class="d-flex justify-content-between">
                    <h1 class="m-t-0 w-100 text-center"><b>{{ $heading }}</b></h1>
                </div>

                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="align-middle text-center">Sl.</th>
                            <th class="align-middle text-center">Name</th>
                            <th class="align-middle text-center">Email</th>
                            <th class="align-middle text-center">Phone</th>
                            <th class="align-middle text-center">Net ID</th>
                            <th class="align-middle text-center">Status</th>
                            <th class="align-middle text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td class="align-middle text-center">{{ ++$loop->index }}</td>
                                <td class="align-middle text-center">{{ $customer->name }}</td>
                                <td class="align-middle text-center">{{ $customer->email }}</td>
                                <td class="align-middle text-center">{{ $customer->phone }}</td>
                                <td class="align-middle text-center">{{ get_customer_netid($customer->user_id)->net_id }}</td>
                                <td class="align-middle text-center">
                                    {{-- <a class="btn btn-sm btn-primary" href="">Active</a> --}}
                                    @if ( $customer->status == 0)
                                        <span>Inactive</span>
                                    @elseif($customer->status == 2)
                                        {{-- <a class="btn btn-sm btn-primary" href="{{ route('customer.inactive',$customer->id) }}">Active</a> --}}
                                        <span>Inactive</span>
                                    @else
                                        {{-- <a class="btn btn-sm btn-primary" href="{{ route('customer.active',$customer->id) }}" >Inactive</a> --}}
                                        <span>Active</span>
                                    @endif

                                </td>
                                
                                <td class="align-middle text-center">
                                    <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ActiveModel{{ $customer->id }}">Active</a>
                                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#view{{ $customer->id }}">View</button>
                                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#changepackage{{ $customer->id }}">Change Package</button>
                                </td>
                            </tr>
                            <!-- Edit modal content -->
                                <div id="ActiveModel{{ $customer->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">User Registration</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col col-sm-12 col-md-6">
                                                        @php
                                                            $data = customer_package($customer->package_id)   
                                                        @endphp
                                                        <div class="card m-b-20 card-inverse text-white" style="background-color: #333; border-color: #333;">
                                                            <div class="card-body">
                                                                <h3 class="card-title">{{ $data->package_title }}</h3>
                                                                <h5 class="card-title">{{ $data->package_speed }}</h5>
                                                                <p class="card-text">{{ $data->package_discription }}</p>
                                                                <h1 class="card-title">৳{{ $data->package_price }}</h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label>Client Name :</label>
                                                            <label class="form-control">{{ $customer->name }}</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Client Email :</label>
                                                            <label class="form-control">{{ $customer->email }}</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Client Phone :</label>
                                                            <label class="form-control">{{ $customer->phone }}</label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label>Client NID :</label>
                                                            <label class="form-control">{{ $customer->nid }}</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Client PON MAC :</label>
                                                            <label class="form-control">{{ $customer->pon_mac }}</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Client Route MAC :</label>
                                                            <label class="form-control">{{ $customer->route_mac }}</label>
                                                        </div>
                                                    </div>
                                                        
                                                    <div class="col col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label>Client Route MAC :</label>
                                                            <textarea class="form-control h-100 w-100" rows="10" cols="50" readonly>
                                                                {{ $customer->address }}
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                    
                                                </div>

                                                <div class="d-flex justify-content-end">
                                                    <a class="btn btn-sm btn-primary" href="{{ route('customer.inactive',$customer->id) }}">Reactive</a>
                                                </div>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>

                            {{-- View Modal  --}}
                            <div id="view{{ $customer->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">User Registration</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col col-sm-12 col-md-6">
                                                    @php
                                                        $data = customer_package($customer->package_id)   
                                                    @endphp
                                                    <div class="card m-b-20 card-inverse text-white">
                                                        <div class="card-body bg-success">
                                                            <h3 class="card-title">{{ $data->package_title }}</h3>
                                                            <h5 class="card-title">{{ $data->package_speed }}</h5>
                                                            <p class="card-text">{{ $data->package_discription }}</p>
                                                            <h1 class="card-title">৳{{ $data->package_price }}</h1>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label>Client Name :</label>
                                                        <label class="form-control">{{ $customer->name }}</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Client Email :</label>
                                                        <label class="form-control">{{ $customer->email }}</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Client Phone :</label>
                                                        <label class="form-control">{{ $customer->phone }}</label>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label>Client NID :</label>
                                                        <label class="form-control">{{ $customer->nid }}</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Client PON MAC :</label>
                                                        <label class="form-control">{{ $customer->pon_mac }}</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Client Route MAC :</label>
                                                        <label class="form-control">{{ $customer->route_mac }}</label>
                                                    </div>
                                                    
                                                </div>
                                                    
                                                <div class="col col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label>Client Route MAC :</label>
                                                        <textarea class="form-control h-100 w-100" rows="5" cols="50" readonly>{{ $customer->address }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>User Id*</label>
                                                        <label class="form-control">{{ get_customer_netid($customer->user_id)->net_id }}</label>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            {{-- Change Package Modal  --}}
                            <div id="changepackage{{ $customer->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">User Registration</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('customer.change.package') }}">
                                                @csrf
                                                <input type="hidden" value="{{ $customer->id }}" name="cust_id">
                                                <div class="row">
                                                    <div class="col col-sm-12 col-md-4 selection-wrapper">
                                                        @php
                                                            $data = customer_package($customer->package_id)   
                                                        @endphp
                                                        <label for="selected-item-{{ $data->id }}" class="card selected-label">
                                                            <input type="radio" name="package_id" id="selected-item-{{ $data->id }}" value="{{ $data->id }}" checked>
                                                            <span class="icon"></span>
                                                            <div class="selected-content bg-success">
                                                                <h3 class="card-title">{{ $data->package_title }}</h3>
                                                                <h5 class="card-title">{{ $data->package_speed }}</h5>
                                                                <p class="card-text">{{ $data->package_discription }}</p>
                                                                <h1 class="card-title">৳{{ $data->package_price }}</h1>
                                                            </div>
                                                        </label>
                                                    </div>

                                                    @foreach (get_allpackage() as $package)
                                                        @if ($data->id != $package->id)
                                                            <div class="col col-sm-12 col-md-4 selection-wrapper">
                                                                <label for="selected-item-{{ $package->id }}" class="card selected-label">
                                                                    <input type="radio" name="package_id" id="selected-item-{{ $package->id }}" value="{{ $package->id }}">
                                                                    <span class="icon"></span>
                                                                    <div class="selected-content">
                                                                        <h3 class="card-title">{{ $package->package_title }}</h3>
                                                                        <h5 class="card-title">{{ $package->package_speed }}</h5>
                                                                        <p class="card-text">{{ $package->package_discription }}</p>
                                                                        <h1 class="card-title">৳{{ $package->package_price }}</h1>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                    <button type="submit" class="btn btn-primary">Change</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection