@extends('layouts.app')
@section('content')
<div class="card-box">
    {{-- Data tables For Admin Start --}}
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
                <h1 class="m-t-0 header-title" style="font-size:40px; text-align:center; margin-bottom:50px !important;"><b>List Of Invioce</b></h1>
                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="align-middle text-center">Sl No.</th>
                            <th class="align-middle text-center">Invioce Id</th>
                            <th class="align-middle text-center">Invioce Date</th>
                            <th class="align-middle text-center">Customer Name</th>
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
                                <td>{{ $invioce->customer->name }}</td>
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
    </div>
    {{-- Data tables For Admin Start --}}
</div>
@endsection