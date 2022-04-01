@extends('layouts.app')
@section('content')
<div class="card-box">
    <!-- Insert modal content -->
    <div id="InsertModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add Package</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('package.store') }}" data-parsley-validate novalidate>
                    @csrf
                        <div class="form-group">
                            <label for="userName">Package Title*</label>
                            <input type="text" name="package_title" parsley-trigger="change" required
                            placeholder="Enter Package Title" class="form-control" id="userName">
                        </div>
                        @error('package_title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="userName">Package Speed*</label>
                            <input type="text" name="package_speed" parsley-trigger="change" required
                            placeholder="Enter Package Speed" class="form-control" id="userName" min="0">
                        </div>
                        @error('package_speed')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="userName">Package Price*</label>
                            <input type="number" name="package_price" parsley-trigger="change" required
                            placeholder="Enter Package Price" class="form-control" id="userName" min="0">
                        </div>
                        @error('package_price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="userName">Package Discription*</label>
                            <textarea name="package_discription" placeholder="Enter Package Discription" class="form-control"></textarea>
                        </div>
                        @error('package_discription')
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
    <!-- /.modal -->
    <div class="form-group text-right m-b-0">
        <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#InsertModal">Add Package</button>
    </div>
    <div class="row">
        
        @foreach ($packages as $package)
            <div class="col-lg-4 col-md-4 col-sm-6 col-12" >
                <div class="card m-b-20 card-inverse text-white {{ ($package->status == 1) ? 'bg-success' : 'bg-danger' }}">
                    <div class="card-body">
                        <h3 class="card-title">{{ $package->package_title }}</h3>
                        <h5 class="card-title">{{ $package->package_speed }}</h5>
                        <p class="card-text">{{ $package->package_discription }}</p>
                        <h1 class="card-title">৳{{ $package->package_price }}</h1>
                        <div class="btn-group package_btn_group">
                            <a data-toggle="modal" data-target="#EditModal{{ $package->id }}"><i class="fas fa-edit"></i></a>
                            @if ($package->status == 1)
                                <a href="{{ route('package.inactive',$package->id) }}" class="package_btn">Inactive</i></a>
                            @else
                                <a href="{{ route('package.active',$package->id) }}" class="package_btn">Active</i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit modal content -->
            <div id="EditModal{{ $package->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Edit Package</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('package.update') }}" data-parsley-validate novalidate>
                                @csrf
                                <input type="hidden" name="id" value="{{ $package->id }}">
                                    <div class="form-group">
                                        <label for="userName">Package Title*</label>
                                        <input type="text" name="package_title" parsley-trigger="change" required
                                        placeholder="Enter Package Title" class="form-control" id="userName" value="{{ $package->package_title }}">
                                    </div>
                                    @error('package_title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <label for="userName">Package Speed*</label>
                                        <input type="text" name="package_speed" parsley-trigger="change" required
                                        placeholder="Enter Package Speed" class="form-control" id="userName" min="0" value="{{ $package->package_speed }}">
                                    </div>
                                    @error('package_speed')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <label for="userName">Package Price*</label>
                                        <input type="number" name="package_price" parsley-trigger="change" required
                                        placeholder="Enter Package Price" class="form-control" id="userName" min="0"value="{{ $package->package_price }}">
                                    </div>
                                    @error('package_price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <label for="userName">Package Discription*</label>
                                        <textarea name="package_discription" placeholder="Enter Package Discription" class="form-control">{{ $package->package_discription }}</textarea>
                                    </div>
                                    @error('package_discription')
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
            <!-- /.modal -->
        @endforeach
    </div>
</div>
@endsection

@section('section_script')
{{-- toastr js --}}
    <script>
        @if(Session::has('succsess'))
            // Display a success toast, with a title
            toastr.success('You Have Successfully Created Package', 'Congratulation!')
        @endif
        @if(Session::has('succsessedit'))
            // Display a success toast, with a title
            toastr.success('You Have Successfully update Package', 'Congratulation!')
        @endif
        @if(Session::has('succsessinactive'))
            // Display a success toast, with a title
            toastr.success('You Have Successfully Inactive Package', 'Congratulation!')
        @endif
        @if(Session::has('succsessactive'))
            // Display a success toast, with a title
            toastr.success('You Have Successfully active Package', 'Congratulation!')
        @endif


        @if ($errors->any())
            // Display an error toast, with a title
            toastr.error('You Have Any Error', 'Sorry!')
        @endif
    </script>
@endsection