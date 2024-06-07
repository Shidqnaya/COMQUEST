<?php

namespace App\Http\Controllers;

use App\Models\Bab;
use App\Models\Matkul;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChapterController extends Controller
{
    // Display the list of babs for a selected matkul
    public function index(Matkul $matkul)
    {
        $user = Auth::user();
        $babs = $matkul->babs()->get();
        return view('user.bab', compact('matkul', 'babs','user'));
    }
}
