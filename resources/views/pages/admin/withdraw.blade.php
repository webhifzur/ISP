@extends('layouts.app')
@section('content')
    <div class="card-box">

        @if (Auth::user()->type == 0)
            <!-- /Insert modal Btn -->
            <div class="form-group text-right m-b-0">
                <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#InsertModal">Add Withdraw</button>
            </div>
            <!-- Insert modal content -->
            <div id="InsertModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Withdraw</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('withdraw.store') }}" data-parsley-validate novalidate>
                                @csrf
                                <div class="form-group">
                                    <label for="amount">Purpose Amount*</label>
                                    <input type="text" name="amount" parsley-trigger="change" required
                                    placeholder="Enter Amount" class="form-control" id="amount" min="0">
                                </div>
                                @error('amount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="userName">Given To*</label>
                                    <select class="form-control" name="user_id" id="">
                                        @foreach (get_admins() as $admin)
                                            <option value="{{ $admin->id }}">
                                                {{ $admin->name }}
                                            </option>   
                                        @endforeach
                                    </select>
                                </div>
                                @error('user_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="container m-2" style="border: 1px solid red;">
                                    <h5 class="text-center text-danger">Give Your Password To Complete Oparetion</h5>
                                    <div class="form-group">
                                        <label for="pass1">Password*</label>
                                        <input id="pass1" name="password" type="password" placeholder="Password" required
                                            class="form-control" autocomplete="new-password">
                                        @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="passWord2">Confirm Password *</label>
                                        <input data-parsley-equalto="#pass1" name="password_confirmation" type="password" required
                                            placeholder="Confirm Password" class="form-control" id="passWord2" autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        @endif
        
        {{-- Data tables For Admin Start --}}
        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <h1 class="m-t-0 header-title" style="font-size:40px; text-align:center; margin-bottom:50px !important;"><b>List Of Withdraw</b></h1>

                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="align-middle text-center">sl.</th>
                            <th class="align-middle text-center">Given To</th>
                            <th class="align-middle text-center">Amount</th>
                            <th class="align-middle text-center">Date & Time</th>
                            @if (Auth::user()->type == 0)
                                <th class="align-middle text-center">Action</th>
                            @endif
                        </tr>
                        </thead>


                        <tbody>
                            @foreach($withdraws as $withdraw)
                                <tr>
                                    <td class="align-middle text-center">{{ ++$loop->index }}</td>
                                    <td class="align-middle text-center">{{ $withdraw->user->name }}</td>
                                    <td class="align-middle text-center">{{ $withdraw->amount }}</td>
                                    <td class="align-middle text-center">{{ $withdraw->created_at }}</td>
                                    @if (Auth::user()->type == 0)
                                        <td class="align-middle text-center">
                                            <button  class="btn btn-success btn-sm rounded-0" data-toggle="modal" data-target="#editModal{{ $withdraw->id }}">
                                                <i class="far fa-edit"></i>
                                            </button>

                                            <!-- Edit Modal Start-->
                                            <div id="editModal{{ $withdraw->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">Edit Withdraw</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('withdraw.update') }}" data-parsley-validate novalidate>
                                                                @csrf
                                                                <input type="hidden" name="user_id" value="{{ $withdraw->id }}" >
                                                                {{-- <input type="text" value="{{ $withdraw->user->id }}"> --}}
                                                                <div class="form-group">
                                                                    <label for="amount">Purpose Amount*</label>
                                                                    <input type="text" name="amount" parsley-trigger="change" required
                                                                    placeholder="Enter Amount" class="form-control" id="amount" min="0" value="{{ $withdraw->amount }}">
                                                                </div>
                                                                @error('amount')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                    
                                                                <div class="container m-2" style="border: 1px solid red;">
                                                                    <h5 class="text-center text-danger">Give Your Password To Complete Oparetion</h5>
                                                                    <div class="form-group">
                                                                        <label for="pass1">Password*</label>
                                                                        <input id="pass1" name="password" type="password" placeholder="Password" required
                                                                            class="form-control" autocomplete="new-password">
                                                                        @error('password')
                                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                                    @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="passWord2">Confirm Password *</label>
                                                                        <input data-parsley-equalto="#pass1" name="password_confirmation" type="password" required
                                                                            placeholder="Confirm Password" class="form-control" id="passWord2" autocomplete="new-password">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div>
                                        </td>    
                                    @endif
                                    
                                    
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

@section('section_script')
{{-- toastr js --}}
    <script>
        @if(Session::has('succsess'))
            // Display a success toast, with a title
            toastr.success('You Have Successfully Created Withdraw', 'Congratulation!')
        @endif
        @if(Session::has('succsessedit'))
            // Display a success toast, with a title
            toastr.success('You Have Successfully update Withdraw', 'Congratulation!')
        @endif


        @if ($errors->any())
            // Display an error toast, with a title
            toastr.error('You Have Any Error', 'Sorry!')
        @endif
    </script>
@endsection