<?php

namespace App\Http\Controllers;
use App\Models\Bab;
use App\Models\Matkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BabController extends Controller
{
    public function create(Matkul $matkul)
    {
        return view('admin.babform', compact('matkul'));
    }

    public function store(Request $request, Matkul $matkul)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $matkul->babs()->create($request->only('name'));
        return redirect()->route('admin.bab.create', $matkul->id)->with('success', 'Bab created successfully.');
    }

    public function update(Request $request, Matkul $matkul, Bab $bab)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $bab->update($request->only('name'));
        return redirect()->route('admin.bab.create', $matkul->id)->with('success', 'Bab updated successfully.');
    }

    public function destroy(Matkul $matkul, Bab $bab)
    {
        $bab->delete();
        return redirect()->route('admin.bab.create', $matkul->id)->with('success', 'Bab deleted successfully.');
    }
}