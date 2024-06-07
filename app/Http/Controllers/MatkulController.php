<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Matkul;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MatkulController extends Controller
{
    public function usersearch(Request $request)
    {
        $user = Auth::user();
        $query = $request->input('query');
        
        // Cari Matkul berdasarkan nama atau kode
        $matkuls = Matkul::where('name', 'LIKE', "%$query%")
                        ->orWhere('code', 'LIKE', "%$query%")
                        ->get();

        return view('user.dashboard', ['user' => $user,'matkuls' => $matkuls, 'query' => $query]);
    }

    public function adminsearch(Request $request)
    {
        $user = Auth::user();
        $query = $request->input('query');
        
        // Cari Matkul berdasarkan nama atau kode
        $matkuls = Matkul::where('name', 'LIKE', "%$query%")
                        ->orWhere('code', 'LIKE', "%$query%")
                        ->get();

        return view('admin.dashboard', ['user' => $user,'matkuls' => $matkuls, 'query' => $query]);
    }


    public function create()
    {
        return view('admin.matkulform');
    }
    //index will take admin to the form that creates a new matkul

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:matkuls',
            'semester' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // Cek apakah file foto diunggah
        if ($request->hasFile('foto')) {
            // Store new avatar and update user's avatar path
            $imageName = time().'.'. $request->foto->extension();
            $request->foto->move(public_path('matkulfoto'), $imageName);
        } else {
            // Jika tidak ada foto diunggah, gunakan nilai default atau kosong
            $imageName = '';
        }
        // return dd($imageName);

        // Create the Matkul
        $matkul = new Matkul;
        $matkul->name = $request->name;
        $matkul->code = $request->code;
        $matkul->semester = $request->semester;
        $matkul->photo = $imageName;

        if ($matkul->save()) {
            return redirect()->route('admin.dashboard')->with('success', 'Matkul created successfully.');
        } else {
            return back()->with('error', 'Failed to create Matkul.');
        }
    }




    public function edit(Matkul $matkul)
    {
        return view('admin.matkuledit', compact('matkul'));
    }

    public function update(Request $request, $id)
    {

        $matkul = Matkul::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:matkuls',
            'semester' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);


        // Update avatar if provided
        if ($request->hasFile('url_foto')) {
            // Delete old avatar if exists
            if ($matkul->photo) {
                Storage::delete($matkul->photo);
            }

            // Store new avatar and update user's avatar path
            $imageName = time().'.'. $request->url_foto->extension(); // Menggunakan metode extension() pada UploadedFile
            $request->url_foto->move(public_path('matkulfoto'), $imageName);
        }

        $matkul->name = $request->name;
        $matkul->code = $request->code;
        $matkul->semester = $request->semester;
        $matkul->photo = $imageName;

        if ($matkul->update()) {
            return redirect()->route('admin.dashboard')->with('success', 'Matkul Updated successfully.');
        } else {
            return back()->with('error', 'Failed to Update Matkul.');
        }
    }

    public function destroy(Matkul $matkul)
    {

        $matkul->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Matkul deleted successfully.');
    }
}
