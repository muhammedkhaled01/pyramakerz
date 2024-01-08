<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSettingController extends Controller
{
    public function profile($id)
    {
        $user = User::findOrFail($id);
        return view("user.profile")->with("user", $user);
    }
    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();


        $status = $user->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'User updated successfully ');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }

        return redirect()->back();
    }
}
