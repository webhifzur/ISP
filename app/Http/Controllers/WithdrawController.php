<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use App\Models\User;
// use App\Models\AdminModel;


use App\Models\WithdrawModel;

class WithdrawController extends Controller
{
    public function __construct()
    {
        $this->middleware('customerrules');
    }

    public function index()
    {
        return view('pages.admin.withdraw', [
            'withdraws' => WithdrawModel::all(),
        ]);
    }

    public function store(Request $request)
    {
        // return $request->all();
        $this->validation();
        if (Hash::check($request->password, Auth::user()->password)) {
            // return $request->all();
            WithdrawModel::create($this->validation());
            return redirect()->route('withdraw')->with('succsess', 'add successfully');
        }

        return redirect()->route('withdraw')->with('succsess', 'Not successfully');
        
    }

    public function update(Request $request)
    {
        
        $this->validation();
        if (Hash::check($request->password, Auth::user()->password)) {
            
            
            WithdrawModel::where("user_id", $request->id)->update(
                [
                    "amount" => $request->amount,
                ]
            );
            return redirect()->route('withdraw')->with('succsessedit', 'add successfully');
        }

        return redirect()->route('withdraw');
        
    }

    public function validation()
    {
        return request()->validate([
            'user_id' => 'required',
            'amount' => 'required',
            'password' => ['required', 'string', 'confirmed'],
        ]);
    }
}
