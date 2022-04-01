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


class ProfileController extends Controller
{
    public function index()
    {
        // return view('admin.adminlist');
        $user = User::where('id', Auth::user()->id)->first();
        return view('pages.profile',['user' => $user]);
    }

    public function update(Request $request)
    {

        
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
            // 'phone' => ['required', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone' => ['required'],
        ]);


        $fileNameToStore = "";
        
        if(request()->hasFile('profile_img')){

            $user = User::where('id', Auth::user()->id)->first();
            if($user->profile_img){
                unlink('storage/'.$user->profile_img);
            }

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

        User::where("id", Auth::user()->id)->update(
            [
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                "profile_img" => $fileNameToStore,
            ]
        );

        if (Auth::user()->type == 1) {
            AdminModel::where("user_id", Auth::user()->id)->update(
                [
                    "address" => $request->address,
                ]
            );
        }

        $user = User::where('id', Auth::user()->id)->first();
        return redirect()->route('dashboard.profile')->with(['user' => $user]);
    }

    public function updatepassword(Request $request)
    {
        $request->validate([
            'oldpassword' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed'],
        ]);

        if (Hash::check($request->oldpassword, Auth::user()->password)) {
            User::where('id', Auth::user()->id)->update(
                [
                    'password'=>Hash::make($request->password),
                ]
            );

            $user = User::where('id', Auth::user()->id)->first();
            return redirect()->route('dashboard.profile')->with(['user' => $user]);
        }

        

        $user = User::where('id', Auth::user()->id)->first();
        return redirect()->route('dashboard.profile')->with(['user' => $user])->with('oldpassword', 'Old Password does not match..');
    }
}
