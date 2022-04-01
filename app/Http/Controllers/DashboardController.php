<?php

namespace App\Http\Controllers;

use App\Models\ExpenseModel;
use App\Models\InvioceModel;
use App\Models\PackageModel;
use Illuminate\Http\Request;
use App\Models\CustomerModel;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('customerrules' ,['except' => ['index', 'welcome']]);
    }



    public function welcome(){
        if (!Auth::check())
        {
            return view('auth.login');
        }
        $this->index();
        return redirect()->route('dashboard');
    }
    
  


    public function index()
    {
        
        if(Auth::user()->type == 3){
            return view('dashboard', [
                'total_invioce' => InvioceModel::where('cust_id', Auth::user()->customer->id)->get(),
            ]);
        }
        return view('dashboard', [
            'customers' => CustomerModel::count(),
            'packages' => PackageModel::count(),
            'active_customers' => CustomerModel::where('status', 1)->count(),
            'inactive_customers' => CustomerModel::where('status', '!=', 1)->count(),
            'total_incomes' => InvioceModel::sum('package_price'),
            'total_cost' => ExpenseModel::sum('amount'),
            'invoices' => InvioceModel::count(),
            'activecustomers' => CustomerModel::where('status', 1)->get(),
            'inactivecustomers' => CustomerModel::where('status', 2)->get(),
        ]);
    }

    public function filterdate(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $dashboard_data = [
            'customers' => CustomerModel::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count(),
           
            'packages' => PackageModel::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count(),

            'active_customers' => CustomerModel::where('status', 1)->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count(),

            'inactive_customers' => CustomerModel::where('status', '!=', 1)->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count(),

            'invoices' => InvioceModel::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count(),
            
            'total_incomes' => InvioceModel::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->sum('package_price'),
            'total_cost' => ExpenseModel::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->sum('amount'),
        ];
        return $dashboard_data;
    }

    public function sendmessage()
    {
        $inactivecustomers = CustomerModel::where('status', 2)->get();
        foreach($inactivecustomers as $inactivecustomer){
            //Start Mobile Sms Notification
            $to = $inactivecustomer->phone;
            $token = "ef5ffbea48fcdbb315bffd9d56f8c077";
            $message = "Dear, " . $inactivecustomer->name .
            ".\nYour current package is inactive." . "\n" .
            "your Id : " . $inactivecustomer->user->net_id . "\n" .
            "Pay your bill to get unintarupted connection.\n" .
            "Given By, NetMGT.\n" .
            "Thank You.!!";
            
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
        }
        return back()->with('succsess', 'Message Sent Successfully To All...!!');
    }

    public function sendmessagesingle($id)
    {
        // return $id;
        $inactivecustomer = CustomerModel::where('id', $id)->first();
        // return $inactivecustomer->user->net_id;
        //Start Mobile Sms Notification
        $to = $inactivecustomer->phone;
        $token = "ef5ffbea48fcdbb315bffd9d56f8c077";
        $message = "Dear, " . $inactivecustomer->name . 
            ".\nYour current package is inactive." . "\n" . 
            "your Id : " . $inactivecustomer->user->net_id . "\n" .
            "Pay your bill to get unintarupted connection.\n".
            "Given By, NetMGT.\n".
            "Thank You.!!";

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
        return back()->with('succsess', 'Message Sent Successfully...!!');
    }
}
