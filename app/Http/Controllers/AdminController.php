<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Matkul;
use App\Models\User;
use App\Models\Item;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $matkuls = Matkul::all();
        return view('admin.dashboard',['user' => $user, 'matkuls' => $matkuls]);
    }


    public function profile(){
        $user = Auth::user();
        return view('admin.profile',['user' => $user]);
    }

    public function toko(){
        $user = Auth::user();
        $items = Item::all();
        return view('admin.toko',['user' => $user, 'items' => $items]);
    }


    public function update(Request $request, string $id)
    {
        // Validate data
        $request->validate([
            'username' => 'required|unique:users,username,' . $id,
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'gender' => 'required',
            'password' => 'nullable|min:8',
            'avatar' => 'nullable|image|max:2048',
        ]);

        // Find user by ID
        $user = User::findOrFail($id);

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
    if ($request->hasFile('foto')) {
        // Delete old avatar if exists
        if ($user->avatar) {
            Storage::delete($user->avatar);
        }

        // Store new avatar and update user's avatar path
        $imageName = time().$request->file('foto')->extension(); // Menggunakan metode extension() pada UploadedFile
        $request->file('foto')->move(public_path('userpfp'), $imageName);
        $user->avatar = $imageName;
    }

        // Simpan perubahan
        $user->save();
        return view('admin.profile',['user' => $user]);
    }

    public function resetscoreall()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->score = 0;
            $user->save();
        }
        return back()->with('success', 'Score reset successfully.');
    }

}
