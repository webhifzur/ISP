<?php

use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;


function customer_package($id)
{
    return App\Models\PackageModel::where('id', $id)->first();
}

function get_customer_netid($id){
    return App\Models\User::where('id', $id)->first();
}

function newusernotification()
{
    $notifications =[];


    $datas = App\Models\CustomerModel::orderBy('updated_at', 'asc')->get();

    $count = 0;
    foreach ($datas as $key => $data) {
        if($data->user_id == '' ){
            // return (Carbon::now()->diffInHours($data->created_at))/24;
            $create_notification = [
                'id' => $data->id,
                'username' => $data->name,
                'message' => 'New User, Active Now',
                'ago' => $data->created_at->diffForHumans(),
                'messagetype' => 'newuser',
            ];
            array_push($notifications, $create_notification);
        }
        if(((Carbon::now()->diffInHours($data->active_date))/24)>30 && $data->status == 2){
            $create_notification = [
                'id' => $data->id,
                'username' => $data->name,
                'message' => 'Date Expire',
                'ago' => $data->active_date,
                'messagetype' => 'dateexpire',
            ];
            array_push($notifications, $create_notification);
        }
    }

    return $notifications;
}


function usernotification(){
    $datas = App\Models\CustomerModel::where('user_id',Auth::id())->first();
    if (((Carbon::now()->diffInHours($datas->active_date)) / 24) > 25 && ((Carbon::now()->diffInHours($datas->active_date)) / 24) < 30 ) {
       return 'Your package will expire withing '. intval(30 - ((Carbon::now()->diffInHours($datas->active_date)) / 24));
    }

    return 'Your package expired '. intval((Carbon::now()->diffInHours($datas->active_date)) / 24);
}



function get_allpackage()
{
    return App\Models\PackageModel::all();
}


function get_admins()
{
    return App\Models\User::where('type', 1)->get();
}



