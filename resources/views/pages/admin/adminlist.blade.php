@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
                <div class="d-flex justify-content-between">
                    <h1 class="m-t-0 w-100 text-center"><b>Admin List</b></h1>
                    @if (Auth::user()->type == 0)
                        <div>
                            <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".admin-add-modal">Add New Admin</button>

                            <!--  Modal content for the above example -->
                            <div class="modal fade admin-add-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('dashboard.admin.create') }}"
                                                data-parsley-validate novalidate enctype="multipart/form-data">
                                                @csrf

                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="card-box">
                                                            <input type="file" class="dropify" data-default-file="" name="profile_img" />
                                                            @error('profile_img')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="userName">User Name*</label>
                                                            <input type="text" name="name" parsley-trigger="change" required
                                                                placeholder="Enter Full Name" class="form-control" id="userName">
                                                            @error('name')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="emailAddress">Email address*</label>
                                                            <input type="email" name="email" parsley-trigger="change" required
                                                                placeholder="Enter email" class="form-control" id="emailAddress">
                                                            @error('email')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="emailAddress">Phone*</label>
                                                            <input type="tel" name="phone" parsley-trigger="change" required
                                                                placeholder="Enter Phone" class="form-control" id="phoneNumber">
                                                            @error('phone')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="userName">Profit Percentage(%)*</label>
                                                            <input type="number" name="profit_percentage" parsley-trigger="change" required
                                                                placeholder="Enter Profit Percentage" class="form-control" id="">
                                                            @error('profit_percentage')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="userName">Slect Admin Type*</label>
                                                            <select class="form-control" name="user_type" id="">
                                                                <option value="1">Admin</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
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
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="address">Address*</label>
                                                            <textarea class="form-control w-100 h-100" name="address" id="" cols="" rows="5"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group text-right m-b-0">
                                                    <button type="reset" class="btn btn-secondary waves-effect waves-light m-l-5">
                                                        Reset
                                                    </button>
                                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                                                        Submit
                                                    </button>
                                                </div>

                                            </form>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </div>
                    @endif
                    
                </div>

                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="align-middle text-center">Name</th>
                            <th class="align-middle text-center">Email</th>
                            <th class="align-middle text-center">Phone</th>
                            <th class="align-middle text-center">Profit Percentage</th>  
                           
                            
                            @if (Auth::user()->type == 0)
                                <th class="align-middle text-center">Action</th>
                            @endif
                            
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($users)>0)
                            @foreach($users as $user)
                                @if ($user->id != Auth::id() && $user->type == 1 )
                                    <tr>
                                        <td class="align-middle text-center">{{ $user->name }}</td>
                                        <td class="align-middle text-center">{{ $user->email }}</td>
                                        <td class="align-middle text-center">{{ $user->phone }}</td>
                                        
                                        <td class="align-middle text-center">{{ $user->admin->profit_percentage }}%</td>    
                                        
                                        
                                        @if (Auth::user()->type == 0)
                                        <td class="align-middle text-center">
                                            <a href="{{ route('admin.delete',$user->id) }}" class="btn btn-danger btn-sm rounded-0" >
                                                <i class="far fa-trash-alt"></i>
                                            </a>

                                            {{-- Edit Modal Button --}}
                                            <button  class="btn btn-success btn-sm rounded-0" data-toggle="modal" data-target="#editModal{{ $user->id }}">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <!-- Edit Modal Start-->
                                            <div id="editModal{{ $user->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">Edit {{ $user->name }}</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form method="POST" action="{{ route('admin.edit', $user->id) }}"
                                                                data-parsley-validate novalidate enctype="multipart/form-data">
                                                                @csrf

                                                                {{-- <input type="text" value="{{ $user->id }}" name="id_to_edit"> --}}

                                                                <div class="row">
                                                                    <div class="col-md-6 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="userName">Profit Percentage(%)*</label>
                                                                            <input type="number" name="profit_percentage" parsley-trigger="change" required
                                                                                   placeholder="Enter Profit Percentage" class="form-control" id="" value="{{ $user->admin->profit_percentage }}">
                                                                            @error('profit_percentage')
                                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="userName">Slect Admin Type*</label>
                                                                            <select class="form-control" name="user_type" id="">
                                                                                <option value="1">Admin</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                                                                <div class="form-group text-right m-b-0">
                                                                    <button type="reset" class="btn btn-secondary waves-effect waves-light m-l-5">
                                                                        Reset
                                                                    </button>
                                                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                                                                        Submit
                                                                    </button>
                                                                </div>

                                                            </form>

                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div>
                                            <!-- Edit Modal End -->
                                        </td>
                                        @endif
                                        
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('section_script')
     {{-- toastr js --}}
        <script>
            @if(Session::has('success'))
                // Display a success toast, with a title
                toastr.success('Your Successfully  Registered', 'Congratulation!')
            @endif
            @if(Session::has('deletesuccess'))
                // Display a success toast, with a title
                toastr.success('Your Delete Successfully', 'Congratulation!')
            @endif
            @if(Session::has('editsuccess'))
                // Display a success toast, with a title
                toastr.success('Your Edited Successfully', 'Congratulation!')
            @endif
        
            @if ($errors->any())
                // Display an error toast, with a title
                toastr.error('You Have Any Error', 'Sorry!')
            @endif
        </script>
@endsection