@extends('layouts.app')
@section('content')
    <div class="card-box">
        <!-- /Insert modal Btn -->
        <div class="form-group text-right m-b-0">
            <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#InsertModal">Add Expense</button>
        </div>
        <!-- Insert modal content -->
        <div id="InsertModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add Expense</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('expense.store') }}" data-parsley-validate novalidate>
                        @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" >
                            <div class="form-group">
                                <label for="purpose">Purpose Title*</label>
                                <input type="text" name="purpose" parsley-trigger="change" required
                                placeholder="Enter Purpose Title" class="form-control" id="purpose">
                            </div>
                            @error('purpose')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="amount">Purpose Amount*</label>
                                <input type="text" name="amount" parsley-trigger="change" required
                                placeholder="Enter Amount" class="form-control" id="amount" min="0">
                            </div>
                            @error('amount')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        
        {{-- Data tables For Admin Start --}}
        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <h1 class="m-t-0 header-title" style="font-size:40px; text-align:center; margin-bottom:50px !important;"><b>List Of Expense</b></h1>

                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="align-middle text-center">sl.</th>
                            <th class="align-middle text-center">Expense Title</th>
                            <th class="align-middle text-center">Amount</th>
                            <th class="align-middle text-center">Date & Time</th>
                            <th class="align-middle text-center">Insert By</th>
                            <th class="align-middle text-center">Action</th>
                        </tr>
                        </thead>


                        <tbody>
                            @foreach($expenses as $expense)
                                <tr>
                                    <td class="align-middle text-center">{{ ++$loop->index }}</td>
                                    <td class="align-middle text-center">{{ $expense->purpose }}</td>
                                    <td class="align-middle text-center">{{ $expense->amount }}</td>
                                    <td class="align-middle text-center">{{ $expense->created_at }}</td>
                                    <td class="align-middle text-center">{{ $expense->user->name }}</td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('expense.delete',$expense->id) }}" class="btn btn-danger btn-sm rounded-0" >
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <button  class="btn btn-success btn-sm rounded-0" data-toggle="modal" data-target="#editModal{{ $expense->id }}">
                                            <i class="far fa-edit"></i>
                                        </button>

                                        <!-- Edit Modal Start-->
                                        <div id="editModal{{ $expense->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Edit Expense</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('expense.update', $expense->id) }}" data-parsley-validate novalidate>
                                                            @csrf
                                                            
                                                            <div class="form-group">
                                                                <label for="purpose">Purpose Title*</label>
                                                                <input type="text" name="purpose" parsley-trigger="change" required
                                                                placeholder="Enter Purpose Title" class="form-control" id="purpose" value="{{ $expense->purpose }}">
                                                            </div>
                                                            @error('purpose')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                            <div class="form-group">
                                                                <label for="amount">Purpose Amount*</label>
                                                                <input type="text" name="amount" parsley-trigger="change" required
                                                                placeholder="Enter Amount" class="form-control" id="amount" min="0" value="{{ $expense->amount }}">
                                                            </div>
                                                            @error('amount')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                                                                </div>
                                                        </form>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                        <!-- Edit Modal End -->
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

@section('section_script')
{{-- toastr js --}}
    <script>
        @if(Session::has('succsess'))
            // Display a success toast, with a title
            toastr.success('You Have Successfully Add Expence', 'Congratulation!')
        @endif
        @if(Session::has('succsessedit'))
            // Display a success toast, with a title
            toastr.success('You Have Successfully update Expence', 'Congratulation!')
        @endif
        @if(Session::has('succsessdelete'))
            // Display a success toast, with a title
            toastr.success('You Have Successfully delete Expence', 'Congratulation!')
        @endif


        @if ($errors->any())
            // Display an error toast, with a title
            toastr.error('You Have Any Error', 'Sorry!')
        @endif
    </script>
@endsection