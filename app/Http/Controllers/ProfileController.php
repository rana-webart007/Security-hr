<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Security, Admin};
use Auth;

class ProfileController extends Controller
{
    //

    public function securityprofile()
    {
           $detail = Security::whereId(Auth::guard('security')->user()->id)->first();
           $id = Auth::guard('security')->user()->id;
           return view('security.profile', compact('detail', 'id'));
    }

    public function securityProfileUpdate(Request $request, $id)
    {
           $request->validate([
                'name' => 'required|max:200',
                'email' => 'required|email|max:200',
                'mobile' => 'required|max:200',
                'phone' => 'required|max:200',
                'address' => 'required|max:200',
           ]);

           Security::whereId($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'phone_no' => $request->phone,
                'address' => $request->address,
           ]);

           return back()->with('profile_update', 'Successfully Updated');
    }

    // 

    public function adminProfile()
    {
          $detail = Admin::whereId(Auth::guard('admin')->user()->id)->first();
          $id = Auth::guard('admin')->user()->id;
          return view('admin.profile', compact('detail', 'id'));
    }

    public function adminProfileUpdate(Request $request, $id)
    {
          $request->validate([
               'name' => 'required|max:200',
               'email' => 'required|email|max:200',
          ]);

          Admin::whereId($id)->update([
               'name' => $request->name,
               'email' => $request->email,
          ]);

          return back()->with('profile_update', 'Successfully Updated');
    }
}