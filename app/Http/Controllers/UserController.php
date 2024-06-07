<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use illuminate\Support\Facades\Auth;
use App\Models\Matkul;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Item;
use App\Models\UserItem;
class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $matkuls = Matkul::all();  // Retrieve all matkuls
        return view('user.dashboard',['user' => $user, 'matkuls'=>$matkuls] );
    }


    public function profile(){
        $user = Auth::user();
        return view('user.profile',['user' => $user]);
    }

    public function toko()
    {
        $user = Auth::user();
        
        // Get the IDs of items the user has already purchased
        $purchasedItemIds = UserItem::where('user_id', $user->id)->pluck('item_id')->toArray();
        
        // Get the items that the user has not purchased
        $items = Item::whereNotIn('id', $purchasedItemIds)->get();
        
        return view('user.toko', ['user' => $user, 'items' => $items]);
    }

    public function update(Request $request)
{
    $user = Auth::user();
    
    // Validate data
    $request->validate([
        'username' => 'required|unique:users,username,' . $user->id,
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'gender' => 'required',
        'password' => 'nullable|min:8',
        'avatar' => 'nullable|image|mimes:jpeg,jfif,png,jpg,gif,svg|max:2048',
    ]);

    // Update user attributes
    $user->username = $request->input('username');
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->gender = $request->input('gender');

    // Update password if provided
    if ($request->filled('password')) {
        $user->password = bcrypt($request->input('password'));
    }

    // Update avatar if provided
    if ($request->hasFile('avatar')) {
        // Delete old avatar if exists
        if ($user->avatar) {
            Storage::delete($user->avatar);
        }

        // Store new avatar and update user's avatar path
        $imageName = time().$request->file('avatar')->extension(); // Menggunakan metode extension() pada UploadedFile
        $request->file('avatar')->move(public_path('userpfp'), $imageName);
        $user->avatar = $imageName;
    }

    

    // Save changes
    $user->save();

    return view('user.profile', ['user' => $user]);
}

    
    
}
