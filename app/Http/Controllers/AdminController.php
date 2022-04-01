<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\AdminModel;




class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('customerrules');
    }


    
    public function index()
    {
        // return view('admin.adminlist');
        $users = User::latest()->get();
        return view('pages.admin.adminlist',['users' => $users]);
    }


    public function create(Request $request)
    {   

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'unique:users'],
            'profit_percentage' => ['required'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'confirmed'],
        ]);


        $fileNameToStore = "";
        
        if(request()->hasFile('profile_img')){
    		// Get filename with the extension
            $filenameWithExt = $request->file('profile_img')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('profile_img')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= 'profile-photos/'.$filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('profile_img')->storeAs('public', $fileNameToStore);
    	}

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->type = $request->user_type;
        $user->profile_img = $fileNameToStore;
        $user->password = Hash::make($request->password);
        $user->save();

        $admin = new AdminModel();
        $admin->user_id = $user->id;
        $admin->profit_percentage = $request->profit_percentage;
        $admin->status = 1;
        $admin->address = $request->address;
        $admin->save();

        return redirect()->back()->with('success' , 'Admin Created Successfully');
        
    }

    public function delete($id)
    {
		$user = User::find($id);
        
        if($user->profile_img){
		    unlink('storage/'.$user->profile_img);
		}
        $user->delete();
        $admin = AdminModel::where('user_id', $id)->delete();
        if($user){
    		$notification = array(
	            'messege' => 'user deleted Successful',
	            'alert-type' => 'success',
	        );
    		return redirect()->back()->with('deletesuccess', 'Admin delete Successfully');
    	}else{
    		$notification = array(
	            'messege' => 'Ups..user not deleted',
	            'alert-type' => 'error',
	        );
	        return redirect()->back()->with('deletesuccess', 'Admin delete Successfully');
    	}
    }

    public function edit($id ,Request $request)
    {
		// return $id;
        $request->validate([
            'profit_percentage' => ['required'],
            'password' => ['required', 'string', 'confirmed'],
        ]);

        

        if (Auth::user()->type == 0) {

            if (Hash::check($request->password, Auth::user()->password)) {
                // $user = User::find($id);
                // return $user;

                AdminModel::where('user_id',$id)->update(
                    [
                        'profit_percentage'=>$request->profit_percentage,
                    ]
                );
                User::where('id',$id)->update(
                    [
                        'type'=>$request->user_type,
                    ]
                );
            }

            
        }

        return redirect()->back()->with('editsuccess', 'Admin Edit Successfully');

    }

}
