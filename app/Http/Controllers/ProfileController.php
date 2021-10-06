<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        if ($user == NULL) {
            return back()->with('error', 'User not found!');
        }

        return view('profile.index', [
            'title' => 'Profile',
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $username)
    {
        $user = User::firstWhere('username', $username);

        if ($user == NULL) {
            return back()->with('error', 'User not found!');
        }

        // cek user name apakah diganti / tidak
        if ($user->username == $request->username) {
            $rule_username = 'required|string|min:3|max:255|alpha_dash';
        } else {
            $rule_username = 'required|string|min:3|max:255|alpha_dash|unique:users';
        }

        // cek no. telp apakah diganti / tidak
        if ($user->phone == $request->phone) {
            $rule_phone = 'required|string|min:3|max:255|alpha_dash';
        } else {
            $rule_phone = 'required|string|min:8|max:12|regex:/8[0-9]/|unique:users';
        }

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'username' => $rule_username,
            'phone' => $rule_phone,
            'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('image_path')) {
            $fileNameToStore = Parent::storeImage($request, 'user', 500, 500);

            // Delete old image
            if ($user->image_path != 'default.png') {
                unlink('images/user/' . $user->image_path);
            }

            // Update data
            $user->update(
                [
                    'name' => ucwords($request->input('name')),
                    'username' => $request->input('username'),
                    'phone' => $request->input('phone'),
                    'image_path' => $fileNameToStore
                ]
            );
        } else {
            $user->update(
                [
                    'name' => ucwords($request->input('name')),
                    'username' => $request->input('username'),
                    'phone' => $request->input('phone')
                ]
            );
        }

        return redirect()
            ->route('profile.index')
            ->with('success', 'Your profile has been updated successfully');
    }
}
