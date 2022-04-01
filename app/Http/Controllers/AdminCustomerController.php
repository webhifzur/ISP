<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\User;
use App\Models\InvioceModel;
use App\Models\PackageModel;
use Illuminate\Http\Request;
use App\Models\CustomerModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminCustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('customerrules');
    }

    public function customerall(){
        return view('pages.admin.customerlistall',[
            'customers' => CustomerModel::where('status','!=', 0)->get(),
            'heading' => "ALl Customer List"
        ]);
    }
    public function customeractivelist(){
        return view('pages.admin.customerlistactive',[
            'customers' => CustomerModel::where('status', 1)->get(),
            'heading' => "Active Customer List"
        ]);
    }
    public function customerinactivelist(){
        return view('pages.admin.customerlistinactive',[
            'customers' => CustomerModel::where('status', 2)->get(),
            'heading' => "Inactive Customer List"
        ]);
    }
    public function customernewlist(){
        return view('pages.admin.customerlistnew',[
            'customers' => CustomerModel::where('status', 0)->get(),
            'heading' => "New Request Customer List"
        ]);
    }

    public function customerregister(Request $request)
    {
        // return $request->net_id;
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'net_id' =>['required', 'unique:users', 'max:255'],
            'password' => 'required',
        ]);
        $customer = CustomerModel::where('id', $request->id)->first();
        $package = PackageModel::where('id', $customer->package_id)->first();
        $user_id = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'net_id' => $request->net_id,
            'password' => Hash::make($request->password),
        ]);


        CustomerModel::where('id', $request->id)->update([

            'active_date' => Carbon::now(),
            'user_id' => $user_id->id,
            'status' => 1,
        ]);

        InvioceModel::create([
            'invoice_no' => "ASF-" . time(),
            'package_title' => $package->package_title,
            'package_speed' => $package->package_speed,
            'package_price' => $package->package_price,
            'created_by' => Auth::id(),
            'cust_id' => $request->id,
        ]);

        //Start Mobile Sms Notification
        $to = $request->phone;
        $token = "ef5ffbea48fcdbb315bffd9d56f8c077";
        $message = "Congratulation " . $request->name . "!! Welcome to our company.". "\n". "your Id : ". $request->net_id . "\n" . "Your password : " . $request->password;

        $url = "http://api.greenweb.com.bd/api.php?json";



        $data = array(
            'to' => "$to",
            'message' => "$message",
            'token' => "$token"
        ); // Add parameters in key value
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);

        //Result
        // echo $smsresult;
        //Error Display
        // echo curl_error($ch);

        //End Mobile Sms Notification


        return redirect()->route('customer.activelist')->with('succsess', 'add successfully');
    }

    public function customeractive($id)
    {
        CustomerModel::where('id', $id)->update([
            'status' => 2,
        ]);
        InvioceModel::where('cust_id', $id)->update([
            'status' => 0,
        ]);
        return back()->with('succsess', 'add successfully');
    }

    public function customerinactive($id)
    {
        $cust = CustomerModel::where('id',$id)->first();

        $package = PackageModel::where('id', $cust->package_id)->first();
        
        CustomerModel::where('id',$id)->update([
            'status' => 1,
        ]);
        InvioceModel::create([
            'invoice_no' => "ASF-" . time(),
            'package_title' => $package->package_title,
            'package_speed' => $package->package_speed,
            'package_price' => $package->package_price,
            'created_by' => Auth::id(),
            'cust_id' => $id,
            'status' => 1,
        ]);
        //Start Mobile Sms Notification
        $to = $cust->phone;
        $token = "ef5ffbea48fcdbb315bffd9d56f8c077";
        $message = "Congratulation " . $cust->name . "!! Welcome to our company." . "\n" . "your account is activated";

        $url = "http://api.greenweb.com.bd/api.php?json";

        $data = array(
            'to' => "$to",
            'message' => "$message",
            'token' => "$token"
        ); // Add parameters in key value
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);

        //Result
        // echo $smsresult;
        //Error Display
        // echo curl_error($ch);

        //End Mobile Sms Notification

        return back()->with('succsess', 'add successfully');
    }

    public function customerdelete($id)
    {
        CustomerModel::where('id', $id)->delete();
        return back()->with('succsess', 'Delete successfully');
    }

    public function changepackage(Request $request)
    {
        
        CustomerModel::where('id' , $request->cust_id)->update([
            'package_id' => $request->package_id,
        ]);
        return back()->with('succsess', 'Change successfully');
    }

}
