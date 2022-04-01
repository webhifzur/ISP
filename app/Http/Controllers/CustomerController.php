<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PackageModel;
use App\Models\CustomerModel;

class CustomerController extends Controller
{
    public function index(){
        return view('pages.customer.customerform',[
            'packages' => PackageModel::where('status',1)->get(),
        ]);
    }

    public function store(Request $request)
    {
        // return $request->all();
        CustomerModel::create($this->validation());
        return redirect()->route('registration.form')->with('succsess', 'add successfully');
    }
    public function validation()
    {
        return request()->validate([
            'package_id' => 'required',
            'name' => 'required',
            'email' => ['unique:customer_models'],
            'phone' => ['required', 'unique:customer_models'],
            'nid' => ['required', 'unique:customer_models'],
            'pon_mac' => ['required'],
            'route_mac' => ['required'],
            'address' => 'required',
        ]);
    }
}
